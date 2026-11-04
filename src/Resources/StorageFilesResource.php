<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\FileResourceData;
use Vented\Data\StoreFileData;
use Vented\Data\UpdateFileData;
use Vented\Results\BinaryResult;
use Vented\Results\CollectionResult;
use Vented\Results\NoContentResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class StorageFilesResource
{
    public function __construct(private Vented $client) {}

    /**
     * Create files or a folder in a storage
     *
     * Operation: projects.storages.files.store
     *
     * @param  array<string, mixed>  $query
     * @return CollectionResult<FileResourceData>
     */
    public function create(string $project, string $environment, string $storage, StoreFileData $data, array $query = []): CollectionResult
    {
        $operation = $this->client->operation('POST', '/projects/{project}/{environment}/storages/{storage}/files')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'storage' => $storage])
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
     * Delete a file or folder
     *
     * Operation: projects.storages.files.destroy
     *
     * @param  array<string, mixed>  $query
     */
    public function delete(string $project, string $environment, string $storage, string $file, array $query = []): NoContentResult
    {
        $operation = $this->client->operation('DELETE', '/projects/{project}/{environment}/storages/{storage}/files/{file}')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'storage' => $storage, 'file' => $file])
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
    public function download(string $project, string $environment, string $storage, string $file, array $query = []): BinaryResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/{environment}/storages/{storage}/files/{file}/download')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'storage' => $storage, 'file' => $file])
            ->withQuery($query)
            ->withHeaders(['Accept' => 'application/octet-stream']);

        return $operation->binary();
    }

    /**
     * Show a file or folder
     *
     * Operation: projects.storages.files.show
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<FileResourceData>
     */
    public function find(string $project, string $environment, string $storage, string $file, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/{environment}/storages/{storage}/files/{file}')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'storage' => $storage, 'file' => $file])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): FileResourceData => FileResourceData::fromArray(self::attributes($resource, false)));
    }

    /**
     * List a folder in a storage
     *
     * Operation: projects.storages.files.index
     *
     * @param  array<string, mixed>  $query
     * @return CollectionResult<FileResourceData>
     */
    public function list(string $project, string $environment, string $storage, array $query = []): CollectionResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/{environment}/storages/{storage}/files')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'storage' => $storage])
            ->withQuery($query);

        return $operation->collection(static fn (array $resource): FileResourceData => FileResourceData::fromArray(self::attributes($resource, false)));
    }

    /**
     * Rename or move a file or folder
     *
     * Operation: projects.storages.files.update
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<FileResourceData>
     */
    public function update(string $project, string $environment, string $storage, string $file, UpdateFileData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('PATCH', '/projects/{project}/{environment}/storages/{storage}/files/{file}')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'storage' => $storage, 'file' => $file])
            ->withBody([
                'data' => [
                    'type' => 'files',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): FileResourceData => FileResourceData::fromArray(self::attributes($resource, false)));
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
