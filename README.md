# Vented for Laravel

The official Laravel package for the Vented JSON:API. It provides generated resource clients, strict readonly DTOs, and one Artisan command for every API-key endpoint.

## Requirements

- PHP 8.3 or later
- Laravel 12 or 13

## Installation

Install the package with Composer:

```bash
composer require vented/vented-laravel
```

Laravel discovers `Vented\VentedServiceProvider` automatically. Publish the configuration if you need to customize it:

```bash
php artisan vendor:publish --tag=vented-config
```

Set the API key in your application environment:

```dotenv
VENTED_API_KEY=your-api-key
VENTED_BASE_URL=https://vented.com
VENTED_COMMANDS_ENABLED=true
```

Optional transport settings are `VENTED_TIMEOUT`, `VENTED_CONNECT_TIMEOUT`, `VENTED_RETRY_TIMES`, and `VENTED_RETRY_DELAY_MILLISECONDS`.

## Usage

Inject the immutable client:

```php
use Vented\Data\StoreProjectData;
use Vented\Vented;

final class SyncProjects
{
    public function __construct(private Vented $vented) {}

    public function __invoke(): void
    {
        $projects = $this->vented->projects()->list();

        foreach ($projects->data as $project) {
            // $project is a generated ProjectData instance.
        }

        $this->vented->projects()->create(new StoreProjectData(
            name: 'Production',
            location_id: 'location-id',
        ));
    }
}
```

```php
use Vented\Facades\Vented;

$result = Vented::projects()->find('project-id');

$rawResponse = $result->response;
```

For multi-account applications, create immutable variants rather than mutating the scoped client:

```php
$customer = $vented->forApiKey($customerToken);
```

Every send creates a fresh Laravel `PendingRequest`. Automatic retries are limited to transient failures on idempotent HTTP methods; POST and PATCH requests are never retried.

## Artisan Commands

Every API-key endpoint has a generated command:

```bash
php artisan vented:projects:list --json
php artisan vented:projects:show project-id --json
php artisan vented:projects:create --data='{"name":"Production","location_id":"location-id"}'
php artisan vented:projects:delete project-id --force
```

Set `VENTED_COMMANDS_ENABLED=false` to avoid registering the generated commands.

## Octane

`Vented` is registered as a scoped service and is recreated for each Octane request or task. Credentials, requests, responses, and resources are never stored statically. Generated operation and command metadata use bounded class constants so workers avoid repeatedly rebuilding immutable tables, while the package version uses one bounded process-wide cache.

## Errors

Missing credentials throw `Vented\Exceptions\MissingApiKeyException`. HTTP errors throw `Vented\Exceptions\ApiException`, which retains the raw Laravel response and parsed JSON:API error objects. Connection failures are normalized to `Vented\Exceptions\TransportException`.

## Generated Code

The client, DTOs, resource methods, endpoint registry, and commands are generated from Vented's OpenAPI contract. Generation happens in Vented's private source repository; no generator, reflection helper, template, or OpenAPI document ships in this package. The generated runtime uses explicit methods and direct hydration without runtime reflection.

## License

The MIT License. See [LICENSE.md](LICENSE.md).
