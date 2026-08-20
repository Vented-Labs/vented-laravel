<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\EnvironmentTransferData;
use Vented\Data\StoreEnvironmentTransferData;
use Vented\Data\UpdateEnvironmentTransferData;
use Vented\Results\CollectionResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class EnvironmentTransfersResource
{
    public function __construct(private Vented $client) {}

    /**
     * Create an environment configuration transfer
     *
     * Operation: projects.environment-transfers.store
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<EnvironmentTransferData>
     */
    public function create(string $project, string $environment, StoreEnvironmentTransferData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/projects/{project}/{environment}/transfers')
            ->withPathParameters(['project' => $project, 'environment' => $environment])
            ->withBody([
                'data' => [
                    'type' => 'environment_transfers',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): EnvironmentTransferData => EnvironmentTransferData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Show an environment configuration transfer
     *
     * Operation: projects.environment-transfers.show
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<EnvironmentTransferData>
     */
    public function find(string $project, string $environment, string $transfer, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/{environment}/transfers/{transfer}')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'transfer' => $transfer])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): EnvironmentTransferData => EnvironmentTransferData::fromArray(self::attributes($resource, true)));
    }

    /**
     * List environment configuration transfers
     *
     * Operation: projects.environment-transfers.index
     *
     * @param  array<string, mixed>  $query
     * @return CollectionResult<EnvironmentTransferData>
     */
    public function list(string $project, string $environment, array $query = []): CollectionResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/{environment}/transfers')
            ->withPathParameters(['project' => $project, 'environment' => $environment])
            ->withQuery($query);

        return $operation->collection(static fn (array $resource): EnvironmentTransferData => EnvironmentTransferData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Update or apply an environment configuration transfer
     *
     * Operation: projects.environment-transfers.update
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<EnvironmentTransferData>
     */
    public function update(string $project, string $environment, string $transfer, UpdateEnvironmentTransferData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('PATCH', '/projects/{project}/{environment}/transfers/{transfer}')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'transfer' => $transfer])
            ->withBody([
                'data' => [
                    'type' => 'environment_transfers',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): EnvironmentTransferData => EnvironmentTransferData::fromArray(self::attributes($resource, true)));
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
