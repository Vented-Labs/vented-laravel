<?php

declare(strict_types=1);

namespace Vented\Facades;

use Illuminate\Support\Facades\Facade;
use Vented\Operation;
use Vented\Resource;
use Vented\Vented as VentedClient;

/**
 * @method static Operation operation(string $method, string $path)
 * @method static Resource resource(string $path)
 * @method static object resourceAccessor(string $name)
 * @method static \Vented\Transport transport()
 * @method static VentedClient forApiKey(string $apiKey)
 * @method static VentedClient forBaseUrl(string $baseUrl)
 *
 * @see VentedClient
 */
final class Vented extends Facade
{
    /**
     * Resolve the scoped binding on every call so facade caching cannot cross an Octane request boundary.
     *
     * @var bool
     */
    protected static $cached = false;

    protected static function getFacadeAccessor(): string
    {
        return VentedClient::class;
    }
}
