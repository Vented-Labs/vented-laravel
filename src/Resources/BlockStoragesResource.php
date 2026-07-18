<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\BlockStorageData;
use Vented\Data\StoreBlockStorageData;
use Vented\Results\CollectionResult;
use Vented\Results\NoContentResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class BlockStoragesResource
{
    public function __construct(private Vented $client) {}

    /**
     * Create a block storage volume
     *
     * Operation: projects.block-storages.store
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<BlockStorageData>
     */
    public function create(string $project, StoreBlockStorageData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/projects/{project}/block-storages')
            ->withPathParameters(['project' => $project])
            ->withBody([
                'data' => [
                    'type' => 'block_storages',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): BlockStorageData => BlockStorageData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Delete a block storage volume
     *
     * Operation: projects.block-storages.destroy
     *
     * @param  array<string, mixed>  $query
     */
    public function delete(string $project, string $storage, array $query = []): NoContentResult
    {
        $operation = $this->client->operation('DELETE', '/projects/{project}/block-storages/{storage}')
            ->withPathParameters(['project' => $project, 'storage' => $storage])
            ->withQuery($query);

        return $operation->noContent();
    }

    /**
     * Show block storage overview
     *
     * Operation: projects.block-storages.show
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<BlockStorageData>
     */
    public function find(string $project, string $storage, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/block-storages/{storage}')
            ->withPathParameters(['project' => $project, 'storage' => $storage])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): BlockStorageData => BlockStorageData::fromArray(self::attributes($resource, true)));
    }

    /**
     * List block storage volumes for a project
     *
     * Operation: projects.block-storages.index
     *
     * @param  array<string, mixed>  $query
     * @return CollectionResult<BlockStorageData>
     */
    public function list(string $project, array $query = []): CollectionResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/block-storages')
            ->withPathParameters(['project' => $project])
            ->withQuery($query);

        return $operation->collection(static fn (array $resource): BlockStorageData => BlockStorageData::fromArray(self::attributes($resource, true)));
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
