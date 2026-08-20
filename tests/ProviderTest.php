<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use Vented\ClientConfiguration;
use Vented\Facades\Vented as VentedFacade;
use Vented\Generated\CommandRegistry;
use Vented\Generated\OperationRegistry;
use Vented\Operation;
use Vented\PackageVersion;
use Vented\Resource;
use Vented\Transport;
use Vented\Vented;

it('loads typed package configuration', function (): void {
    $configuration = $this->app->make(ClientConfiguration::class);

    expect(config('vented.base_url'))->toBe('https://vented.com')
        ->and(config('vented.commands_enabled'))->toBeTrue()
        ->and($configuration->apiKey)->toBe('test-api-key')
        ->and($configuration->timeout)->toBeInt()->toBe(30)
        ->and($configuration->connectTimeout)->toBeInt()->toBe(10)
        ->and($configuration->retryTimes)->toBeInt()->toBe(2)
        ->and($configuration->retryDelayMilliseconds)->toBeInt()->toBe(0)
        ->and(Vented::version())->toBe(trim((string) file_get_contents(dirname(__DIR__).'/VERSION')));
});

it('resolves the public client through the namespaced facade', function (): void {
    $client = $this->app->make(Vented::class);

    expect(VentedFacade::getFacadeRoot())->toBe($client)
        ->and(VentedFacade::resource('/widgets'))->toBeInstanceOf(Resource::class);
});

it('resolves a new client after a scoped lifetime without facade cache leakage', function (): void {
    $first = VentedFacade::getFacadeRoot();

    config()->set('vented.api_key', 'next-scope-key');
    $this->app->forgetScopedInstances();

    $second = VentedFacade::getFacadeRoot();

    expect($second)->not->toBe($first)
        ->and($first->configuration()->apiKey)->toBe('test-api-key')
        ->and($second->configuration()->apiKey)->toBe('next-scope-key');
});

it('does not leak request or credential state between scoped clients', function (): void {
    Http::fake();

    config()->set('vented.api_key', 'first-scope-key');
    $first = $this->app->make(Vented::class);

    config()->set('vented.api_key', 'second-scope-key');
    $this->app->forgetScopedInstances();
    $second = $this->app->make(Vented::class);

    $first->operation('GET', '/first')->withHeaders(['X-Request-Token' => 'first-only'])->send();
    $second->operation('GET', '/second')->send();

    Http::assertSent(fn ($request): bool => str_ends_with($request->url(), '/first')
        && $request->hasHeader('Authorization', 'Bearer first-scope-key')
        && $request->hasHeader('X-Request-Token', 'first-only'));

    Http::assertSent(fn ($request): bool => str_ends_with($request->url(), '/second')
        && $request->hasHeader('Authorization', 'Bearer second-scope-key')
        && ! $request->hasHeader('X-Request-Token'));
});

it('adds resource registrations immutably', function (): void {
    $client = $this->app->make(Vented::class);
    $registered = $client->withResourceAccessor(
        'widgets',
        static fn (Vented $boundClient): Resource => new Resource($boundClient, '/widgets'),
    );

    expect($registered)->not->toBe($client)
        ->and($registered->resourceAccessor('widgets'))->toBeInstanceOf(Resource::class);
});

it('creates immutable credential and endpoint variants without changing the scoped client', function (): void {
    $client = $this->app->make(Vented::class);
    $variant = $client
        ->forApiKey('per-account-key')
        ->forBaseUrl('https://tenant.example.test/');

    expect($variant)->not->toBe($client)
        ->and($client->configuration()->apiKey)->toBe('test-api-key')
        ->and($client->configuration()->baseUrl)->toBe('https://vented.com')
        ->and($variant->configuration()->apiKey)->toBe('per-account-key')
        ->and($variant->configuration()->baseUrl)->toBe('https://tenant.example.test');
});

it('does not retain scoped clients across repeated Octane-style lifetimes', function (): void {
    $references = [];

    for ($index = 0; $index < 100; $index++) {
        config()->set('vented.api_key', "scope-key-{$index}");
        $this->app->forgetScopedInstances();
        $client = $this->app->make(Vented::class);
        $references[] = WeakReference::create($client);
        unset($client);
    }

    $this->app->forgetScopedInstances();
    gc_collect_cycles();

    expect(array_filter($references, static fn (WeakReference $reference): bool => $reference->get() !== null))
        ->toBe([]);
});

it('uses bounded static state only for immutable process metadata', function (): void {
    foreach ([Vented::class, Transport::class, Operation::class] as $class) {
        expect((new ReflectionClass($class))->getProperties(ReflectionProperty::IS_STATIC))
            ->toBe([], "{$class} must not retain request-specific static state.");
    }

    $versionProperties = (new ReflectionClass(PackageVersion::class))
        ->getProperties(ReflectionProperty::IS_STATIC);

    expect($versionProperties)->toHaveCount(1)
        ->and($versionProperties[0]->getName())->toBe('current')
        ->and(OperationRegistry::OPERATIONS)->toHaveCount(108)
        ->and(CommandRegistry::COMMANDS)->toHaveCount(108);
});
