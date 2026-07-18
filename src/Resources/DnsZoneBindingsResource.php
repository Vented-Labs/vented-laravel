<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\AppBindingData;
use Vented\Data\DnsZoneData;
use Vented\Data\StoreAppBindingData;
use Vented\Data\UpdateAppBindingData;
use Vented\Results\NoContentResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class DnsZoneBindingsResource
{
    public function __construct(private Vented $client) {}

    /**
     * Create an app binding
     *
     * Operation: projects.dns.zones.bindings.store
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<AppBindingData>
     */
    public function create(string $project, string $zone, StoreAppBindingData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/projects/{project}/dns/zones/{zone}/bindings')
            ->withPathParameters(['project' => $project, 'zone' => $zone])
            ->withBody([
                'data' => [
                    'type' => 'app_bindings',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): AppBindingData => AppBindingData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Delete an app binding
     *
     * Operation: projects.dns.zones.bindings.destroy
     *
     * @param  array<string, mixed>  $query
     */
    public function delete(string $project, string $zone, string $binding, array $query = []): NoContentResult
    {
        $operation = $this->client->operation('DELETE', '/projects/{project}/dns/zones/{zone}/bindings/{binding}')
            ->withPathParameters(['project' => $project, 'zone' => $zone, 'binding' => $binding])
            ->withQuery($query);

        return $operation->noContent();
    }

    /**
     * List app bindings for a zone
     *
     * Operation: projects.dns.zones.bindings.index
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<DnsZoneData>
     */
    public function list(string $project, string $zone, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/dns/zones/{zone}/bindings')
            ->withPathParameters(['project' => $project, 'zone' => $zone])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): DnsZoneData => DnsZoneData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Update an app binding
     *
     * Operation: projects.dns.zones.bindings.update
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<AppBindingData>
     */
    public function update(string $project, string $zone, string $binding, UpdateAppBindingData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('PATCH', '/projects/{project}/dns/zones/{zone}/bindings/{binding}')
            ->withPathParameters(['project' => $project, 'zone' => $zone, 'binding' => $binding])
            ->withBody([
                'data' => [
                    'type' => 'app_bindings',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): AppBindingData => AppBindingData::fromArray(self::attributes($resource, true)));
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
