<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\ObjectStorageData;
use Vented\Data\StoreObjectStorageData;
use Vented\Results\CollectionResult;
use Vented\Results\NoContentResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class ObjectStoragesResource
{
    public function __construct(private Vented $client) {}

    /**
     * Create an object storage bucket
     *
     * Operation: projects.object-storages.store
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<ObjectStorageData>
     */
    public function create(string $project, string $environment, StoreObjectStorageData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/projects/{project}/{environment}/object-storages')
            ->withPathParameters(['project' => $project, 'environment' => $environment])
            ->withBody([
                'data' => [
                    'type' => 'object_storages',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): ObjectStorageData => ObjectStorageData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Delete an object storage bucket
     *
     * Operation: projects.object-storages.destroy
     *
     * @param  array<string, mixed>  $query
     */
    public function delete(string $project, string $environment, string $storage, array $query = []): NoContentResult
    {
        $operation = $this->client->operation('DELETE', '/projects/{project}/{environment}/object-storages/{storage}')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'storage' => $storage])
            ->withQuery($query);

        return $operation->noContent();
    }

    /**
     * Show object storage overview
     *
     * Operation: projects.object-storages.show
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<ObjectStorageData>
     */
    public function find(string $project, string $environment, string $storage, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/{environment}/object-storages/{storage}')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'storage' => $storage])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): ObjectStorageData => ObjectStorageData::fromArray(self::attributes($resource, true)));
    }

    /**
     * List object storage buckets for an environment
     *
     * Operation: projects.object-storages.index
     *
     * @param  array<string, mixed>  $query
     * @return CollectionResult<ObjectStorageData>
     */
    public function list(string $project, string $environment, array $query = []): CollectionResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/{environment}/object-storages')
            ->withPathParameters(['project' => $project, 'environment' => $environment])
            ->withQuery($query);

        return $operation->collection(static fn (array $resource): ObjectStorageData => ObjectStorageData::fromArray(self::attributes($resource, true)));
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
