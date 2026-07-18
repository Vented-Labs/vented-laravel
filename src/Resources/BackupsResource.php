<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\BackupData;
use Vented\Data\StoreBackupData;
use Vented\Results\NoContentResult;
use Vented\Results\PaginatedResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class BackupsResource
{
    public function __construct(private Vented $client) {}

    /**
     * Create a backup
     *
     * Operation: projects.backups.store
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<BackupData>
     */
    public function create(string $project, StoreBackupData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/projects/{project}/backups')
            ->withPathParameters(['project' => $project])
            ->withBody([
                'data' => [
                    'type' => 'backups',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): BackupData => BackupData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Delete a backup
     *
     * Operation: projects.backups.destroy
     *
     * @param  array<string, mixed>  $query
     */
    public function delete(string $project, string $backup, array $query = []): NoContentResult
    {
        $operation = $this->client->operation('DELETE', '/projects/{project}/backups/{backup}')
            ->withPathParameters(['project' => $project, 'backup' => $backup])
            ->withQuery($query);

        return $operation->noContent();
    }

    /**
     * List project backups
     *
     * Operation: projects.backups.index
     *
     * @param  array<string, mixed>  $query
     * @return PaginatedResult<BackupData>
     */
    public function list(string $project, array $query = []): PaginatedResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/backups')
            ->withPathParameters(['project' => $project])
            ->withQuery($query);

        return $operation->paginated(static fn (array $resource): BackupData => BackupData::fromArray(self::attributes($resource, true)));
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
