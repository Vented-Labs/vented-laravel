<?php

declare(strict_types=1);

namespace Vented;

use Illuminate\Console\Command;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Client\Factory;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Vented\Exceptions\InvalidConfigurationException;
use Vented\Generated\CommandRegistry;
use Vented\Generated\GeneratedResourceRegistry;

class VentedServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('vented')
            ->hasConfigFile();
    }

    public function packageRegistered(): void
    {
        $this->app->scoped(ClientConfiguration::class, static function (Application $app): ClientConfiguration {
            $config = $app->make(Repository::class)->get('vented', []);

            if (! is_array($config)) {
                throw new InvalidConfigurationException('The Vented configuration must be an array.');
            }

            return ClientConfiguration::fromArray($config);
        });

        $this->app->scoped(ResourceRegistry::class, static fn (): ResourceRegistry => GeneratedResourceRegistry::create());

        $this->app->scoped(Vented::class, static fn (Application $app): Vented => new Vented(
            $app->make(Factory::class),
            $app->make(ClientConfiguration::class),
            $app->make(ResourceRegistry::class),
        ));
    }

    public function packageBooted(): void
    {
        if (! $this->app->runningInConsole() || ! config('vented.commands_enabled', true)) {
            return;
        }

        $commands = $this->commandClasses();

        if ($commands !== []) {
            $this->commands($commands);
        }
    }

    /**
     * @return list<class-string<Command>>
     */
    protected function commandClasses(): array
    {
        return CommandRegistry::all();
    }
}
