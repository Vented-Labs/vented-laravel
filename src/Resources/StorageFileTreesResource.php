<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\FileResourceData;
use Vented\Results\CollectionResult;
use Vented\Vented;

final readonly class StorageFileTreesResource
{
    public function __construct(private Vented $client) {}

    /**
     * List everything below a folder
     *
     * Operation: projects.storages.file-trees.index
     *
     * @param  array<string, mixed>  $query
     * @return CollectionResult<FileResourceData>
     */
    public function list(string $project, string $environment, string $storage, array $query = []): CollectionResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/{environment}/storages/{storage}/file-trees')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'storage' => $storage])
            ->withQuery($query);

        return $operation->collection(static fn (array $resource): FileResourceData => FileResourceData::fromArray(self::attributes($resource, false)));
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
