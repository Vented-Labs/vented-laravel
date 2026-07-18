<?php

declare(strict_types=1);

namespace Vented;

use Closure;
use Vented\Exceptions\ResourceNotRegisteredException;

final readonly class ResourceRegistry
{
    /**
     * @param  array<string, Closure(Vented): object>  $factories
     */
    public function __construct(private array $factories = []) {}

    /**
     * @param  Closure(Vented): object  $factory
     */
    public function with(string $name, Closure $factory): self
    {
        return new self([...$this->factories, $name => $factory]);
    }

    public function has(string $name): bool
    {
        return isset($this->factories[$name]);
    }

    public function resolve(string $name, Vented $client): object
    {
        $factory = $this->factories[$name] ?? null;

        if ($factory === null) {
            throw new ResourceNotRegisteredException($name);
        }

        return $factory($client);
    }
}
