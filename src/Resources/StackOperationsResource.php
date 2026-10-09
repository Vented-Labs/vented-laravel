<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\ManagedStackCleanupData;
use Vented\Data\StoreManagedStackOperationData;
use Vented\Data\UpdateManagedStackOperationData;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class StackOperationsResource
{
    public function __construct(private Vented $client) {}

    /**
     * Request cleanup of stack members
     *
     * Operation: projects.stack-operations.store
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<ManagedStackCleanupData>
     */
    public function create(string $project, string $environment, StoreManagedStackOperationData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/projects/{project}/{environment}/stack-operations')
            ->withPathParameters(['project' => $project, 'environment' => $environment])
            ->withBody([
                'data' => [
                    'type' => 'managed_stack_cleanups',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): ManagedStackCleanupData => ManagedStackCleanupData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Retry selected resource cleanup
     *
     * Operation: projects.stack-operations.update
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<ManagedStackCleanupData>
     */
    public function update(string $project, string $environment, string $operation, UpdateManagedStackOperationData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('PATCH', '/projects/{project}/{environment}/stack-operations/{operation}')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'operation' => $operation])
            ->withBody([
                'data' => [
                    'type' => 'managed_stack_cleanups',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): ManagedStackCleanupData => ManagedStackCleanupData::fromArray(self::attributes($resource, true)));
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
