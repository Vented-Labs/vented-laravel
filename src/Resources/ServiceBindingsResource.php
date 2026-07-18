<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\BindingData;
use Vented\Data\StoreBindingData;
use Vented\Results\CollectionResult;
use Vented\Results\NoContentResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class ServiceBindingsResource
{
    public function __construct(private Vented $client) {}

    /**
     * Create a binding from a service
     *
     * Operation: projects.services.bindings.store
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<BindingData>
     */
    public function create(string $project, string $service, StoreBindingData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/projects/{project}/services/{service}/bindings')
            ->withPathParameters(['project' => $project, 'service' => $service])
            ->withBody([
                'data' => [
                    'type' => 'bindings',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): BindingData => BindingData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Delete a binding from a service
     *
     * Operation: projects.services.bindings.destroy
     *
     * @param  array<string, mixed>  $query
     */
    public function delete(string $project, string $service, string $binding, array $query = []): NoContentResult
    {
        $operation = $this->client->operation('DELETE', '/projects/{project}/services/{service}/bindings/{binding}')
            ->withPathParameters(['project' => $project, 'service' => $service, 'binding' => $binding])
            ->withQuery($query);

        return $operation->noContent();
    }

    /**
     * List bindings for a service
     *
     * Operation: projects.services.bindings
     *
     * @param  array<string, mixed>  $query
     * @return CollectionResult<BindingData>
     */
    public function list(string $project, string $service, array $query = []): CollectionResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/services/{service}/bindings')
            ->withPathParameters(['project' => $project, 'service' => $service])
            ->withQuery($query);

        return $operation->collection(static fn (array $resource): BindingData => BindingData::fromArray(self::attributes($resource, true)));
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
