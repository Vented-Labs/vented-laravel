<?php

declare(strict_types=1);

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Vented\Data\AppConfigurationMeta;
use Vented\Data\AppSetupData;
use Vented\Vented;

it('retrieves Filebeam setup credentials through the environment-scoped apps resource', function (): void {
    Http::fake(['*' => Http::response([
        'data' => [
            'type' => 'app_setups',
            'id' => 'app-1',
            'attributes' => ['fields' => [['name' => 'token', 'label' => 'Setup Token', 'value' => 'test-only-setup-token', 'sensitive' => true]], 'path' => '/install', 'port' => 8080],
        ],
    ])]);

    $result = $this->app->make(Vented::class)->apps()->setup('project-1', 'production', 'app-1');

    expect($result->data)->toBeInstanceOf(AppSetupData::class)
        ->and($result->data->id)->toBe('app-1')
        ->and($result->data->fields[0]->name)->toBe('token')
        ->and($result->data->fields[0]->sensitive)->toBeTrue()
        ->and($result->data->fields[0]->value)->toBe('test-only-setup-token')
        ->and($result->data->path)->toBe('/install');

    Http::assertSent(fn (Request $request): bool => $request->method() === 'GET'
        && str_ends_with($request->url(), '/projects/project-1/production/apps/app-1/setup')
        && $request->hasHeader('Accept', 'application/vnd.api+json'));
});

it('preserves nullable generic setup fields when hydrating and serializing', function (): void {
    $setup = AppSetupData::fromArray([
        'id' => 'app-2',
        'path' => '/setup',
        'port' => 3000,
        'fields' => [['name' => 'one_time_code', 'label' => 'One-Time Code', 'value' => null, 'sensitive' => true]],
    ]);

    expect($setup->fields[0]->value)->toBeNull()
        ->and($setup->toArray()['fields'][0])->toBe([
            'label' => 'One-Time Code',
            'name' => 'one_time_code',
            'sensitive' => true,
            'value' => null,
        ]);
});

it('hydrates configured credential paths without mistaking null placeholders for secrets', function (): void {
    $meta = AppConfigurationMeta::fromArray([
        'form_options' => ['versions' => ['0.3.3'], 'schema' => []],
        'current_configuration' => ['policy' => ['database' => ['password' => null]]],
        'configured_secrets' => ['policy.database.password'],
    ]);

    expect($meta->configured_secrets)->toBe(['policy.database.password'])
        ->and($meta->current_configuration)->toBe(['policy' => ['database' => ['password' => null]]]);
});
