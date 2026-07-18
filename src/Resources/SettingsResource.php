<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\ProjectSettingsData;
use Vented\Data\UpdateProjectSettingsData;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class SettingsResource
{
    public function __construct(private Vented $client) {}

    /**
     * Show project settings
     *
     * Operation: projects.settings.show
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<ProjectSettingsData>
     */
    public function find(string $project, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/settings')
            ->withPathParameters(['project' => $project])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): ProjectSettingsData => ProjectSettingsData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Update project settings
     *
     * Operation: projects.settings.update
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<ProjectSettingsData>
     */
    public function update(string $project, UpdateProjectSettingsData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('PATCH', '/projects/{project}/settings')
            ->withPathParameters(['project' => $project])
            ->withBody([
                'data' => [
                    'type' => 'project_settings',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): ProjectSettingsData => ProjectSettingsData::fromArray(self::attributes($resource, true)));
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
