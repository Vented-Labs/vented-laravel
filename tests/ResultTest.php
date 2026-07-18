<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use Vented\Exceptions\InvalidResponseException;
use Vented\Results\BinaryResult;
use Vented\Results\CollectionResult;
use Vented\Results\NoContentResult;
use Vented\Results\PaginatedResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

it('hydrates a resource result and retains its response', function (): void {
    Http::fake(['*' => Http::response([
        'data' => ['type' => 'widgets', 'id' => '1', 'attributes' => ['name' => 'First']],
        'meta' => ['request_id' => 'request-1'],
        'links' => ['self' => '/widgets/1'],
    ])]);

    $result = $this->app->make(Vented::class)
        ->operation('GET', '/widgets/1')
        ->resource(static fn (array $resource): string => $resource['attributes']['name']);

    expect($result)->toBeInstanceOf(ResourceResult::class)
        ->and($result->data)->toBe('First')
        ->and($result->meta)->toBe(['request_id' => 'request-1'])
        ->and($result->links)->toBe(['self' => '/widgets/1'])
        ->and($result->response->status())->toBe(200);
});

it('hydrates collection and pagination results', function (string $resultType): void {
    Http::fake(['*' => Http::response([
        'data' => [
            ['type' => 'widgets', 'id' => '1'],
            ['type' => 'widgets', 'id' => '2'],
        ],
        'meta' => ['page' => ['current' => 1, 'total' => 2]],
        'links' => ['next' => null],
    ])]);

    $operation = $this->app->make(Vented::class)->operation('GET', '/widgets');
    $hydrate = static fn (array $resource): string => $resource['id'];
    $result = $resultType === CollectionResult::class
        ? $operation->collection($hydrate)
        : $operation->paginated($hydrate);

    expect($result)->toBeInstanceOf($resultType)
        ->and($result->data)->toBe(['1', '2'])
        ->and($result->meta)->toBe(['page' => ['current' => 1, 'total' => 2]])
        ->and($result->response->status())->toBe(200);
})->with([CollectionResult::class, PaginatedResult::class]);

it('returns no-content and binary result wrappers', function (): void {
    Http::fake([
        '*/widgets/1' => Http::response(null, 204),
        '*/export' => Http::response('binary-data', 200, ['Content-Type' => 'application/octet-stream']),
    ]);

    $client = $this->app->make(Vented::class);
    $noContent = $client->operation('DELETE', '/widgets/1')->noContent();
    $binary = $client->operation('GET', '/export')
        ->withHeaders(['Accept' => 'application/octet-stream'])
        ->binary();

    expect($noContent)->toBeInstanceOf(NoContentResult::class)
        ->and($noContent->response->status())->toBe(204)
        ->and($binary)->toBeInstanceOf(BinaryResult::class)
        ->and($binary->body)->toBe('binary-data')
        ->and($binary->contentType)->toBe('application/octet-stream')
        ->and($binary->response->status())->toBe(200);
});

it('rejects malformed JSON API result documents', function (): void {
    Http::fake(['*' => Http::response(['data' => 'not-a-resource'])]);

    expect(fn () => $this->app->make(Vented::class)
        ->operation('GET', '/widgets/1')
        ->resource(static fn (array $resource): array => $resource))
        ->toThrow(InvalidResponseException::class);
});
