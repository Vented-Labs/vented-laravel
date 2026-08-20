<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\FileContentData;
use Vented\Data\UpdateFileContentData;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class StorageFileContentsResource
{
    public function __construct(private Vented $client) {}

    /**
     * Read a file
     *
     * Operation: projects.storages.file-contents.show
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<FileContentData>
     */
    public function find(string $project, string $environment, string $storage, string $file, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/{environment}/storages/{storage}/file-contents/{file}')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'storage' => $storage, 'file' => $file])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): FileContentData => FileContentData::fromArray(self::attributes($resource, false)));
    }

    /**
     * Write a file
     *
     * Operation: projects.storages.file-contents.update
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<FileContentData>
     */
    public function update(string $project, string $environment, string $storage, string $file, UpdateFileContentData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('PUT', '/projects/{project}/{environment}/storages/{storage}/file-contents/{file}')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'storage' => $storage, 'file' => $file])
            ->withBody([
                'data' => [
                    'type' => 'file_contents',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): FileContentData => FileContentData::fromArray(self::attributes($resource, false)));
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
