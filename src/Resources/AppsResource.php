<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\AppData;
use Vented\Data\StoreAppData;
use Vented\Data\UpdateAppData;
use Vented\Results\NoContentResult;
use Vented\Results\PaginatedResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class AppsResource
{
    public function __construct(private Vented $client) {}

    /**
     * Show app configuration
     *
     * Operation: projects.apps.configuration
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<AppData>
     */
    public function configuration(string $project, string $environment, string $app, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/{environment}/apps/{app}/configuration')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'app' => $app])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): AppData => AppData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Deploy a new app
     *
     * Operation: projects.apps.store
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<AppData>
     */
    public function create(string $project, string $environment, StoreAppData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/projects/{project}/{environment}/apps')
            ->withPathParameters(['project' => $project, 'environment' => $environment])
            ->withBody([
                'data' => [
                    'type' => 'apps',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): AppData => AppData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Delete an app
     *
     * Operation: projects.apps.destroy
     *
     * @param  array<string, mixed>  $query
     */
    public function delete(string $project, string $environment, string $app, array $query = []): NoContentResult
    {
        $operation = $this->client->operation('DELETE', '/projects/{project}/{environment}/apps/{app}')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'app' => $app])
            ->withQuery($query);

        return $operation->noContent();
    }

    /**
     * Show app overview
     *
     * Operation: projects.apps.show
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<AppData>
     */
    public function find(string $project, string $environment, string $app, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/{environment}/apps/{app}')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'app' => $app])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): AppData => AppData::fromArray(self::attributes($resource, true)));
    }

    /**
     * List apps for an environment
     *
     * Operation: projects.apps.index
     *
     * @param  array<string, mixed>  $query
     * @return PaginatedResult<AppData>
     */
    public function list(string $project, string $environment, array $query = []): PaginatedResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/{environment}/apps')
            ->withPathParameters(['project' => $project, 'environment' => $environment])
            ->withQuery($query);

        return $operation->paginated(static fn (array $resource): AppData => AppData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Restart an app
     *
     * Operation: projects.apps.restart
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<AppData>
     */
    public function restart(string $project, string $environment, string $app, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/projects/{project}/{environment}/apps/{app}/restart')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'app' => $app])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): AppData => AppData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Start an app
     *
     * Operation: projects.apps.start
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<AppData>
     */
    public function start(string $project, string $environment, string $app, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/projects/{project}/{environment}/apps/{app}/start')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'app' => $app])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): AppData => AppData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Stop an app
     *
     * Operation: projects.apps.stop
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<AppData>
     */
    public function stop(string $project, string $environment, string $app, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/projects/{project}/{environment}/apps/{app}/stop')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'app' => $app])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): AppData => AppData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Show app storage attachments
     *
     * Operation: projects.apps.storage
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<AppData>
     */
    public function storage(string $project, string $environment, string $app, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/{environment}/apps/{app}/storage')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'app' => $app])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): AppData => AppData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Update app configuration
     *
     * Operation: projects.apps.update
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<AppData>
     */
    public function update(string $project, string $environment, string $app, UpdateAppData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('PATCH', '/projects/{project}/{environment}/apps/{app}')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'app' => $app])
            ->withBody([
                'data' => [
                    'type' => 'apps',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): AppData => AppData::fromArray(self::attributes($resource, true)));
    }

    /**
     * @param  array<string, mixed>  $resource
     * @return array<string, mixed>
     */
    private static function attributes(array $resource, bool $includeId): array
    {
        $attributes = $resource['attributes'] ?? null;

        if (! is_array($attributes) || array_is_list($attributes)) {
            throw new \UnexpectedValueException('The JSON:API resource attributes must be an object.');
        }

        if ($includeId) {
            $id = $resource['id'] ?? null;

            if (! is_string($id)) {
                throw new \UnexpectedValueException('The JSON:API resource id must be a string.');
            }

            $attributes['id'] = $id;
        }

        return $attributes;
    }
}
