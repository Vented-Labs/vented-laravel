<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\ManagedStackData;
use Vented\Data\StoreManagedStackData;
use Vented\Data\UpdateManagedStackData;
use Vented\Results\CollectionResult;
use Vented\Results\NoContentResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class StacksResource
{
    public function __construct(private Vented $client) {}

    /**
     * Link a managed stack
     *
     * Operation: projects.stacks.store
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<ManagedStackData>
     */
    public function create(string $project, string $environment, StoreManagedStackData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/projects/{project}/{environment}/stacks')
            ->withPathParameters(['project' => $project, 'environment' => $environment])
            ->withBody([
                'data' => [
                    'type' => 'managed_stacks',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): ManagedStackData => ManagedStackData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Unlink a managed stack
     *
     * Operation: projects.stacks.destroy
     *
     * @param  array<string, mixed>  $query
     */
    public function delete(string $project, string $environment, string $stack, array $query = []): NoContentResult
    {
        $operation = $this->client->operation('DELETE', '/projects/{project}/{environment}/stacks/{stack}')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'stack' => $stack])
            ->withQuery($query);

        return $operation->noContent();
    }

    /**
     * View a managed stack
     *
     * Operation: projects.stacks.show
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<ManagedStackData>
     */
    public function find(string $project, string $environment, string $stack, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/{environment}/stacks/{stack}')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'stack' => $stack])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): ManagedStackData => ManagedStackData::fromArray(self::attributes($resource, true)));
    }

    /**
     * List managed stacks
     *
     * Operation: projects.stacks.index
     *
     * @param  array<string, mixed>  $query
     * @return CollectionResult<ManagedStackData>
     */
    public function list(string $project, string $environment, array $query = []): CollectionResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/{environment}/stacks')
            ->withPathParameters(['project' => $project, 'environment' => $environment])
            ->withQuery($query);

        return $operation->collection(static fn (array $resource): ManagedStackData => ManagedStackData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Update a managed stack
     *
     * Operation: projects.stacks.update
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<ManagedStackData>
     */
    public function update(string $project, string $environment, string $stack, UpdateManagedStackData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('PATCH', '/projects/{project}/{environment}/stacks/{stack}')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'stack' => $stack])
            ->withBody([
                'data' => [
                    'type' => 'managed_stacks',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): ManagedStackData => ManagedStackData::fromArray(self::attributes($resource, true)));
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
