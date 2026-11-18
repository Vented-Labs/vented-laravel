<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\BuildConfigData;
use Vented\Data\StoreBuildConfigData;
use Vented\Data\UpdateBuildConfigData;
use Vented\Results\CollectionResult;
use Vented\Results\NoContentResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class BuildConfigsResource
{
    public function __construct(private Vented $client) {}

    /**
     * Create a build configuration
     *
     * Operation: projects.build-configs.store
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<BuildConfigData>
     */
    public function create(string $project, string $environment, StoreBuildConfigData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/projects/{project}/{environment}/build-configs')
            ->withPathParameters(['project' => $project, 'environment' => $environment])
            ->withBody([
                'data' => [
                    'type' => 'build_configs',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): BuildConfigData => BuildConfigData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Delete a build configuration
     *
     * Operation: projects.build-configs.destroy
     *
     * @param  array<string, mixed>  $query
     */
    public function delete(string $project, string $environment, string $buildConfig, array $query = []): NoContentResult
    {
        $operation = $this->client->operation('DELETE', '/projects/{project}/{environment}/build-configs/{buildConfig}')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'buildConfig' => $buildConfig])
            ->withQuery($query);

        return $operation->noContent();
    }

    /**
     * Show a build configuration
     *
     * Operation: projects.build-configs.show
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<BuildConfigData>
     */
    public function find(string $project, string $environment, string $buildConfig, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/{environment}/build-configs/{buildConfig}')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'buildConfig' => $buildConfig])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): BuildConfigData => BuildConfigData::fromArray(self::attributes($resource, true)));
    }

    /**
     * List build configurations
     *
     * Operation: projects.build-configs.index
     *
     * @param  array<string, mixed>  $query
     * @return CollectionResult<BuildConfigData>
     */
    public function list(string $project, string $environment, array $query = []): CollectionResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/{environment}/build-configs')
            ->withPathParameters(['project' => $project, 'environment' => $environment])
            ->withQuery($query);

        return $operation->collection(static fn (array $resource): BuildConfigData => BuildConfigData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Update a build configuration
     *
     * Operation: projects.build-configs.update
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<BuildConfigData>
     */
    public function update(string $project, string $environment, string $buildConfig, UpdateBuildConfigData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('PATCH', '/projects/{project}/{environment}/build-configs/{buildConfig}')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'buildConfig' => $buildConfig])
            ->withBody([
                'data' => [
                    'type' => 'build_configs',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): BuildConfigData => BuildConfigData::fromArray(self::attributes($resource, true)));
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
