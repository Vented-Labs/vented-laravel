<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\BackupData;
use Vented\Results\PaginatedResult;
use Vented\Vented;

final readonly class ObjectStorageBackupsResource
{
    public function __construct(private Vented $client) {}

    /**
     * List backups stored on this bucket
     *
     * Operation: projects.object-storages.backups
     *
     * @param  array<string, mixed>  $query
     * @return PaginatedResult<BackupData>
     */
    public function list(string $project, string $storage, array $query = []): PaginatedResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/object-storages/{storage}/backups')
            ->withPathParameters(['project' => $project, 'storage' => $storage])
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
