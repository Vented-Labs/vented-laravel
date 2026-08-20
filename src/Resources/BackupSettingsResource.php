<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\BackupSettingsData;
use Vented\Data\UpdateBackupSettingsData;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class BackupSettingsResource
{
    public function __construct(private Vented $client) {}

    /**
     * Read backup settings
     *
     * Operation: projects.backup-settings.show
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<BackupSettingsData>
     */
    public function find(string $project, string $environment, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/{environment}/backup-settings')
            ->withPathParameters(['project' => $project, 'environment' => $environment])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): BackupSettingsData => BackupSettingsData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Update backup settings
     *
     * Operation: projects.backup-settings.update
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<BackupSettingsData>
     */
    public function update(string $project, string $environment, UpdateBackupSettingsData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('PATCH', '/projects/{project}/{environment}/backup-settings')
            ->withPathParameters(['project' => $project, 'environment' => $environment])
            ->withBody([
                'data' => [
                    'type' => 'backup_settings',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): BackupSettingsData => BackupSettingsData::fromArray(self::attributes($resource, true)));
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
