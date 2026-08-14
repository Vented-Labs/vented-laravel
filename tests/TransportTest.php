<?php

declare(strict_types=1);

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Vented\Exceptions\ApiException;
use Vented\Exceptions\MissingApiKeyException;
use Vented\Exceptions\TransportException;
use Vented\OptionalValue;
use Vented\Vented;

it('constructs encoded authenticated JSON API requests', function (): void {
    config()->set('vented.base_url', 'https://api.example.test/v1/');
    Http::fake();

    $response = $this->app->make(Vented::class)->transport()->get(
        '/widgets/{widget}',
        ['widget' => 'a/b c'],
        ['include' => 'owner', 'page' => ['number' => 2]],
    );

    expect($response->successful())->toBeTrue();

    Http::assertSent(function (Request $request): bool {
        parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

        return $request->method() === 'GET'
            && parse_url($request->url(), PHP_URL_PATH) === '/v1/widgets/a%2Fb%20c'
            && $query === ['include' => 'owner', 'page' => ['number' => '2']]
            && $request->hasHeader('Authorization', 'Bearer test-api-key')
            && $request->hasHeader('Accept', 'application/vnd.api+json')
            && $request->hasHeader('Content-Type', 'application/vnd.api+json')
            && $request->hasHeader('User-Agent', 'vented-laravel/'.Vented::version());
    });
});

it('sends a JSON API request body', function (): void {
    Http::fake();
    $body = ['data' => ['type' => 'widgets', 'attributes' => ['name' => 'Example']]];

    $this->app->make(Vented::class)->transport()->post('/widgets', $body);

    Http::assertSent(fn (Request $request): bool => $request->method() === 'POST'
        && $request->data() === $body
        && $request->hasHeader('Content-Type', 'application/vnd.api+json'));
});

it('supports every declared JSON API method', function (string $method): void {
    Http::fake();
    $body = in_array($method, ['POST', 'PATCH', 'PUT'], true)
        ? ['data' => ['type' => 'widgets']]
        : OptionalValue::Missing;

    $this->app->make(Vented::class)->transport()->send($method, '/widgets/1', body: $body);

    Http::assertSent(fn (Request $request): bool => $request->method() === $method);
})->with(['GET', 'POST', 'PATCH', 'PUT', 'DELETE']);

it('fails before sending when credentials are missing', function (): void {
    config()->set('vented.api_key');
    Http::fake();

    expect(fn () => $this->app->make(Vented::class)->transport()->get('/widgets'))
        ->toThrow(MissingApiKeyException::class, 'VENTED_API_KEY');

    Http::assertNothingSent();
});

it('retries transient reads', function (): void {
    config()->set('vented.retry_times', 1);
    Http::fake([
        '*' => Http::sequence()
            ->push(['errors' => [['title' => 'Unavailable']]], 503)
            ->push(['data' => []], 200),
    ]);

    $response = $this->app->make(Vented::class)->transport()->get('/widgets');

    expect($response->status())->toBe(200);
    Http::assertSentCount(2);
});

it('does not retry non-idempotent writes', function (string $method): void {
    config()->set('vented.retry_times', 3);
    Http::fake([
        '*' => Http::sequence()
            ->push(['errors' => [['title' => 'Unavailable']]], 503)
            ->push(['data' => []], 200),
    ]);

    expect(fn () => $this->app->make(Vented::class)->transport()->send(
        $method,
        '/widgets',
        body: ['data' => ['type' => 'widgets']],
    ))->toThrow(ApiException::class);

    Http::assertSentCount(1);
})->with(['POST', 'PATCH']);

it('does not retry non-transient API errors', function (): void {
    config()->set('vented.retry_times', 3);
    Http::fake(['*' => Http::response(['errors' => [['title' => 'Invalid']]], 422)]);

    expect(fn () => $this->app->make(Vented::class)->transport()->get('/widgets'))
        ->toThrow(ApiException::class);

    Http::assertSentCount(1);
});

it('normalizes JSON API errors and preserves the raw response', function (): void {
    Http::fake(['*' => Http::response([
        'errors' => [[
            'status' => '422',
            'code' => 'invalid_name',
            'title' => 'Validation failed',
            'detail' => 'The name is required.',
            'source' => ['pointer' => '/data/attributes/name'],
            'meta' => ['request_id' => 'request-1'],
        ]],
    ], 422)]);

    try {
        $this->app->make(Vented::class)->transport()->get('/widgets');
    } catch (ApiException $exception) {
        expect($exception->response->status())->toBe(422)
            ->and($exception->response->json('errors.0.code'))->toBe('invalid_name')
            ->and($exception->errors)->toHaveCount(1)
            ->and($exception->errors[0]->detail)->toBe('The name is required.')
            ->and($exception->errors[0]->source?->pointer)->toBe('/data/attributes/name')
            ->and($exception->errors[0]->meta)->toBe(['request_id' => 'request-1']);

        return;
    }

    $this->fail('Expected an ApiException to be thrown.');
});

it('normalizes connection failures', function (): void {
    Http::fake(static fn () => throw new ConnectionException('DNS failure'));

    expect(fn () => $this->app->make(Vented::class)->transport()->get('/widgets'))
        ->toThrow(TransportException::class, 'DNS failure');
});
