<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\BindingData;
use Vented\Data\StoreBindingData;
use Vented\Results\CollectionResult;
use Vented\Results\NoContentResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class AppBindingsResource
{
    public function __construct(private Vented $client) {}

    /**
     * Create a binding from an app
     *
     * Operation: projects.apps.bindings.store
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<BindingData>
     */
    public function create(string $project, string $environment, string $app, StoreBindingData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/projects/{project}/{environment}/apps/{app}/bindings')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'app' => $app])
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
     * Delete a binding from an app
     *
     * Operation: projects.apps.bindings.destroy
     *
     * @param  array<string, mixed>  $query
     */
    public function delete(string $project, string $environment, string $app, string $binding, array $query = []): NoContentResult
    {
        $operation = $this->client->operation('DELETE', '/projects/{project}/{environment}/apps/{app}/bindings/{binding}')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'app' => $app, 'binding' => $binding])
            ->withQuery($query);

        return $operation->noContent();
    }

    /**
     * List bindings for an app
     *
     * Operation: projects.apps.bindings
     *
     * @param  array<string, mixed>  $query
     * @return CollectionResult<BindingData>
     */
    public function list(string $project, string $environment, string $app, array $query = []): CollectionResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/{environment}/apps/{app}/bindings')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'app' => $app])
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
