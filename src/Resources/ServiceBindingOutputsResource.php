<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\ServiceOutputsData;
use Vented\Results\CollectionResult;
use Vented\Vented;

final readonly class ServiceBindingOutputsResource
{
    public function __construct(private Vented $client) {}

    /**
     * Show a binding's connection details
     *
     * Operation: projects.services.bindings.outputs
     *
     * @param  array<string, mixed>  $query
     * @return CollectionResult<ServiceOutputsData>
     */
    public function list(string $project, string $environment, string $service, string $binding, array $query = []): CollectionResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/{environment}/services/{service}/bindings/{binding}/outputs')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'service' => $service, 'binding' => $binding])
            ->withQuery($query);

        return $operation->collection(static fn (array $resource): ServiceOutputsData => ServiceOutputsData::fromArray(self::attributes($resource, true)));
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
