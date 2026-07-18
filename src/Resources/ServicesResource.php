<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\ServiceData;
use Vented\Data\StoreServiceData;
use Vented\Data\UpdateServiceData;
use Vented\Results\NoContentResult;
use Vented\Results\PaginatedResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class ServicesResource
{
    public function __construct(private Vented $client) {}

    /**
     * Show service configuration
     *
     * Operation: projects.services.configuration
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<ServiceData>
     */
    public function configuration(string $project, string $service, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/services/{service}/configuration')
            ->withPathParameters(['project' => $project, 'service' => $service])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): ServiceData => ServiceData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Install a service
     *
     * Operation: projects.services.store
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<ServiceData>
     */
    public function create(string $project, StoreServiceData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/projects/{project}/services')
            ->withPathParameters(['project' => $project])
            ->withBody([
                'data' => [
                    'type' => 'services',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): ServiceData => ServiceData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Remove a service
     *
     * Operation: projects.services.destroy
     *
     * @param  array<string, mixed>  $query
     */
    public function delete(string $project, string $service, array $query = []): NoContentResult
    {
        $operation = $this->client->operation('DELETE', '/projects/{project}/services/{service}')
            ->withPathParameters(['project' => $project, 'service' => $service])
            ->withQuery($query);

        return $operation->noContent();
    }

    /**
     * Show service overview
     *
     * Operation: projects.services.show
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<ServiceData>
     */
    public function find(string $project, string $service, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/services/{service}')
            ->withPathParameters(['project' => $project, 'service' => $service])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): ServiceData => ServiceData::fromArray(self::attributes($resource, true)));
    }

    /**
     * List services for a project
     *
     * Operation: projects.services.index
     *
     * @param  array<string, mixed>  $query
     * @return PaginatedResult<ServiceData>
     */
    public function list(string $project, array $query = []): PaginatedResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/services')
            ->withPathParameters(['project' => $project])
            ->withQuery($query);

        return $operation->paginated(static fn (array $resource): ServiceData => ServiceData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Update service configuration
     *
     * Operation: projects.services.update
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<ServiceData>
     */
    public function update(string $project, string $service, UpdateServiceData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('PATCH', '/projects/{project}/services/{service}')
            ->withPathParameters(['project' => $project, 'service' => $service])
            ->withBody([
                'data' => [
                    'type' => 'services',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): ServiceData => ServiceData::fromArray(self::attributes($resource, true)));
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
