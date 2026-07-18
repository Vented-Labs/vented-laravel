<?php

declare(strict_types=1);

namespace Vented;

use Closure;
use Illuminate\Http\Client\Factory;
use Vented\Generated\ResourceAccessors;

final readonly class Vented
{
    use ResourceAccessors;

    private ResourceRegistry $resources;

    public function __construct(
        private Factory $http,
        private ClientConfiguration $configuration,
        ?ResourceRegistry $resources = null,
    ) {
        $this->resources = $resources ?? new ResourceRegistry;
    }

    public function configuration(): ClientConfiguration
    {
        return $this->configuration;
    }

    public static function version(): string
    {
        return PackageVersion::current();
    }

    public function forApiKey(string $apiKey): self
    {
        return new self($this->http, $this->configuration->withApiKey($apiKey), $this->resources);
    }

    public function forBaseUrl(string $baseUrl): self
    {
        return new self($this->http, $this->configuration->withBaseUrl($baseUrl), $this->resources);
    }

    public function transport(): Transport
    {
        return new Transport($this->http, $this->configuration);
    }

    public function operation(string $method, string $path): Operation
    {
        return new Operation($this->transport(), $method, $path);
    }

    public function resource(string $path): Resource
    {
        return new Resource($this, $path);
    }

    /**
     * Return a new client with an additional generated resource accessor.
     *
     * @param  Closure(Vented): object  $factory
     */
    public function withResourceAccessor(string $name, Closure $factory): self
    {
        return new self($this->http, $this->configuration, $this->resources->with($name, $factory));
    }

    public function resourceAccessor(string $name): object
    {
        return $this->resources->resolve($name, $this);
    }
}
