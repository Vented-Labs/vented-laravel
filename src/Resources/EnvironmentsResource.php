<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\EnvironmentData;
use Vented\Data\StoreEnvironmentData;
use Vented\Data\UpdateEnvironmentData;
use Vented\Results\CollectionResult;
use Vented\Results\NoContentResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class EnvironmentsResource
{
    public function __construct(private Vented $client) {}

    /**
     * Create an environment
     *
     * Operation: projects.environments.store
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<EnvironmentData>
     */
    public function create(string $project, StoreEnvironmentData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/projects/{project}/environments')
            ->withPathParameters(['project' => $project])
            ->withBody([
                'data' => [
                    'type' => 'environments',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): EnvironmentData => EnvironmentData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Delete an environment
     *
     * Operation: projects.environments.destroy
     *
     * @param  array<string, mixed>  $query
     */
    public function delete(string $project, string $environment, array $query = []): NoContentResult
    {
        $operation = $this->client->operation('DELETE', '/projects/{project}/environments/{environment}')
            ->withPathParameters(['project' => $project, 'environment' => $environment])
            ->withQuery($query);

        return $operation->noContent();
    }

    /**
     * Show an environment
     *
     * Operation: projects.environments.show
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<EnvironmentData>
     */
    public function find(string $project, string $environment, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/environments/{environment}')
            ->withPathParameters(['project' => $project, 'environment' => $environment])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): EnvironmentData => EnvironmentData::fromArray(self::attributes($resource, true)));
    }

    /**
     * List project environments
     *
     * Operation: projects.environments.index
     *
     * @param  array<string, mixed>  $query
     * @return CollectionResult<EnvironmentData>
     */
    public function list(string $project, array $query = []): CollectionResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/environments')
            ->withPathParameters(['project' => $project])
            ->withQuery($query);

        return $operation->collection(static fn (array $resource): EnvironmentData => EnvironmentData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Update an environment
     *
     * Operation: projects.environments.update
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<EnvironmentData>
     */
    public function update(string $project, string $environment, UpdateEnvironmentData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('PATCH', '/projects/{project}/environments/{environment}')
            ->withPathParameters(['project' => $project, 'environment' => $environment])
            ->withBody([
                'data' => [
                    'type' => 'environments',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): EnvironmentData => EnvironmentData::fromArray(self::attributes($resource, true)));
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
