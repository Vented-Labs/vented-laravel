<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\FileResourceData;
use Vented\Data\StoreFileData;
use Vented\Results\BinaryResult;
use Vented\Results\CollectionResult;
use Vented\Results\NoContentResult;
use Vented\Vented;

final readonly class StorageFilesResource
{
    public function __construct(private Vented $client) {}

    /**
     * Create files or a directory in a storage
     *
     * Operation: projects.storages.files.store
     *
     * @param  array<string, mixed>  $query
     * @return CollectionResult<FileResourceData>
     */
    public function create(string $project, string $storage, StoreFileData $data, array $query = []): CollectionResult
    {
        $operation = $this->client->operation('POST', '/projects/{project}/storages/{storage}/files')
            ->withPathParameters(['project' => $project, 'storage' => $storage])
            ->withBody([
                'data' => [
                    'type' => 'files',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->collection(static fn (array $resource): FileResourceData => FileResourceData::fromArray(self::attributes($resource, false)));
    }

    /**
     * Delete a file or directory
     *
     * Operation: projects.storages.files.destroy
     *
     * @param  array<string, mixed>  $query
     */
    public function delete(string $project, string $storage, string $file, array $query = []): NoContentResult
    {
        $operation = $this->client->operation('DELETE', '/projects/{project}/storages/{storage}/files/{file}')
            ->withPathParameters(['project' => $project, 'storage' => $storage, 'file' => $file])
            ->withQuery($query);

        return $operation->noContent();
    }

    /**
     * Download a file
     *
     * Operation: projects.storages.files.download
     *
     * @param  array<string, mixed>  $query
     */
    public function download(string $project, string $storage, string $file, array $query = []): BinaryResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/storages/{storage}/files/{file}/download')
            ->withPathParameters(['project' => $project, 'storage' => $storage, 'file' => $file])
            ->withQuery($query)
            ->withHeaders(['Accept' => 'application/octet-stream']);

        return $operation->binary();
    }

    /**
     * List files in a storage directory
     *
     * Operation: projects.storages.files.index
     *
     * @param  array<string, mixed>  $query
     * @return CollectionResult<FileResourceData>
     */
    public function list(string $project, string $storage, array $query = []): CollectionResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/storages/{storage}/files')
            ->withPathParameters(['project' => $project, 'storage' => $storage])
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
