<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\BuildGroupData;
use Vented\Data\StoreBuildGroupData;
use Vented\Data\UpdateBuildGroupData;
use Vented\Results\NoContentResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class BuildGroupsResource
{
    public function __construct(private Vented $client) {}

    /**
     * Create a build group
     *
     * Operation: projects.build-groups.store
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<BuildGroupData>
     */
    public function create(string $project, string $environment, StoreBuildGroupData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/projects/{project}/{environment}/build-groups')
            ->withPathParameters(['project' => $project, 'environment' => $environment])
            ->withBody([
                'data' => [
                    'type' => 'build_groups',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): BuildGroupData => BuildGroupData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Ungroup build configurations
     *
     * Operation: projects.build-groups.destroy
     *
     * @param  array<string, mixed>  $query
     */
    public function delete(string $project, string $environment, string $buildGroup, array $query = []): NoContentResult
    {
        $operation = $this->client->operation('DELETE', '/projects/{project}/{environment}/build-groups/{buildGroup}')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'buildGroup' => $buildGroup])
            ->withQuery($query);

        return $operation->noContent();
    }

    /**
     * Update a build group
     *
     * Operation: projects.build-groups.update
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<BuildGroupData>
     */
    public function update(string $project, string $environment, string $buildGroup, UpdateBuildGroupData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('PATCH', '/projects/{project}/{environment}/build-groups/{buildGroup}')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'buildGroup' => $buildGroup])
            ->withBody([
                'data' => [
                    'type' => 'build_groups',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): BuildGroupData => BuildGroupData::fromArray(self::attributes($resource, true)));
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
