<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\StorageSettingsData;
use Vented\Data\UpdateStorageSettingsData;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class StorageSettingsResource
{
    public function __construct(private Vented $client) {}

    /**
     * Read storage settings
     *
     * Operation: projects.storage-settings.show
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<StorageSettingsData>
     */
    public function find(string $project, string $environment, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/{environment}/storage-settings')
            ->withPathParameters(['project' => $project, 'environment' => $environment])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): StorageSettingsData => StorageSettingsData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Update storage settings
     *
     * Operation: projects.storage-settings.update
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<StorageSettingsData>
     */
    public function update(string $project, string $environment, UpdateStorageSettingsData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('PATCH', '/projects/{project}/{environment}/storage-settings')
            ->withPathParameters(['project' => $project, 'environment' => $environment])
            ->withBody([
                'data' => [
                    'type' => 'storage_settings',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): StorageSettingsData => StorageSettingsData::fromArray(self::attributes($resource, true)));
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
