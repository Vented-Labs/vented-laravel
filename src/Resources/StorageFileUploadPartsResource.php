<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\FileUploadData;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class StorageFileUploadPartsResource
{
    public function __construct(private Vented $client) {}

    /**
     * Send one part of an upload
     *
     * Operation: projects.storages.file-uploads.parts.update
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<FileUploadData>
     */
    public function update(string $project, string $environment, string $storage, string $upload, string $part, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('PUT', '/projects/{project}/{environment}/storages/{storage}/file-uploads/{upload}/parts/{part}')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'storage' => $storage, 'upload' => $upload, 'part' => $part])
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
