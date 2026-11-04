<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\FileUploadData;
use Vented\Data\StoreFileUploadData;
use Vented\Data\UpdateFileUploadData;
use Vented\Results\NoContentResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class StorageFileUploadsResource
{
    public function __construct(private Vented $client) {}

    /**
     * Start an upload in parts
     *
     * Operation: projects.storages.file-uploads.store
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<FileUploadData>
     */
    public function create(string $project, string $environment, string $storage, StoreFileUploadData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/projects/{project}/{environment}/storages/{storage}/file-uploads')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'storage' => $storage])
            ->withBody([
                'data' => [
                    'type' => 'file_uploads',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): FileUploadData => FileUploadData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Cancel an upload in parts
     *
     * Operation: projects.storages.file-uploads.destroy
     *
     * @param  array<string, mixed>  $query
     */
    public function delete(string $project, string $environment, string $storage, string $upload, array $query = []): NoContentResult
    {
        $operation = $this->client->operation('DELETE', '/projects/{project}/{environment}/storages/{storage}/file-uploads/{upload}')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'storage' => $storage, 'upload' => $upload])
            ->withQuery($query);

        return $operation->noContent();
    }

    /**
     * Show an upload in parts
     *
     * Operation: projects.storages.file-uploads.show
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<FileUploadData>
     */
    public function find(string $project, string $environment, string $storage, string $upload, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/{environment}/storages/{storage}/file-uploads/{upload}')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'storage' => $storage, 'upload' => $upload])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): FileUploadData => FileUploadData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Complete an upload in parts
     *
     * Operation: projects.storages.file-uploads.update
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<FileUploadData>
     */
    public function update(string $project, string $environment, string $storage, string $upload, UpdateFileUploadData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('PATCH', '/projects/{project}/{environment}/storages/{storage}/file-uploads/{upload}')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'storage' => $storage, 'upload' => $upload])
            ->withBody([
                'data' => [
                    'type' => 'file_uploads',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): FileUploadData => FileUploadData::fromArray(self::attributes($resource, true)));
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
