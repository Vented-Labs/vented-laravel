<?php

declare(strict_types=1);

namespace Vented\Tests;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Vented\VentedServiceProvider;

final class GeneratedTestCommand extends Command
{
    protected $signature = 'vented:generated-test';

    public function handle(): int
    {
        return self::SUCCESS;
    }
}

final class ProviderWithGeneratedCommand extends VentedServiceProvider
{
    protected function commandClasses(): array
    {
        return [GeneratedTestCommand::class];
    }
}

it('does not load generated commands when commands are disabled', function (): void {
    config()->set('vented.commands_enabled', false);

    $this->app->register(ProviderWithGeneratedCommand::class);

    expect(Artisan::all())->not->toHaveKey('vented:generated-test');
});

it('loads generated commands only in an enabled console application', function (): void {
    config()->set('vented.commands_enabled', true);

    $this->app->register(ProviderWithGeneratedCommand::class);

    expect(Artisan::all())->toHaveKey('vented:generated-test');
    $this->artisan('vented:generated-test')->assertSuccessful();
});
