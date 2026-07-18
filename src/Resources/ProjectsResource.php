<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\ProjectData;
use Vented\Data\StoreProjectData;
use Vented\Data\UpdateProjectData;
use Vented\Results\CollectionResult;
use Vented\Results\NoContentResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class ProjectsResource
{
    public function __construct(private Vented $client) {}

    /**
     * Create a new project
     *
     * Operation: projects.store
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<ProjectData>
     */
    public function create(StoreProjectData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/projects')
            ->withBody([
                'data' => [
                    'type' => 'projects',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): ProjectData => ProjectData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Delete a project
     *
     * Operation: projects.destroy
     *
     * @param  array<string, mixed>  $query
     */
    public function delete(string $project, array $query = []): NoContentResult
    {
        $operation = $this->client->operation('DELETE', '/projects/{project}')
            ->withPathParameters(['project' => $project])
            ->withQuery($query);

        return $operation->noContent();
    }

    /**
     * Show a single project
     *
     * Operation: projects.overview
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<ProjectData>
     */
    public function find(string $project, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}')
            ->withPathParameters(['project' => $project])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): ProjectData => ProjectData::fromArray(self::attributes($resource, true)));
    }

    /**
     * List the authenticated user's projects
     *
     * Operation: projects.index
     *
     * @param  array<string, mixed>  $query
     * @return CollectionResult<ProjectData>
     */
    public function list(array $query = []): CollectionResult
    {
        $operation = $this->client->operation('GET', '/projects')
            ->withQuery($query);

        return $operation->collection(static fn (array $resource): ProjectData => ProjectData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Update a project
     *
     * Operation: projects.update
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<ProjectData>
     */
    public function update(string $project, UpdateProjectData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('PATCH', '/projects/{project}')
            ->withPathParameters(['project' => $project])
            ->withBody([
                'data' => [
                    'type' => 'projects',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): ProjectData => ProjectData::fromArray(self::attributes($resource, true)));
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
