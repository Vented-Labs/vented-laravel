<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\DnsStatusData;
use Vented\Data\DnsZoneData;
use Vented\Data\StoreZoneData;
use Vented\Data\UpdateZoneData;
use Vented\Results\BinaryResult;
use Vented\Results\CollectionResult;
use Vented\Results\NoContentResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class DnsZonesResource
{
    public function __construct(private Vented $client) {}

    /**
     * Create a DNS zone
     *
     * Operation: projects.dns.zones.store
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<DnsZoneData>
     */
    public function create(string $project, StoreZoneData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/projects/{project}/dns/zones')
            ->withPathParameters(['project' => $project])
            ->withBody([
                'data' => [
                    'type' => 'dns_zones',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): DnsZoneData => DnsZoneData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Delete a DNS zone
     *
     * Operation: projects.dns.zones.destroy
     *
     * @param  array<string, mixed>  $query
     */
    public function delete(string $project, string $zone, array $query = []): NoContentResult
    {
        $operation = $this->client->operation('DELETE', '/projects/{project}/dns/zones/{zone}')
            ->withPathParameters(['project' => $project, 'zone' => $zone])
            ->withQuery($query);

        return $operation->noContent();
    }

    /**
     * Export a DNS zone
     *
     * Operation: projects.dns.zones.export
     *
     * @param  array<string, mixed>  $query
     */
    public function export(string $project, string $zone, array $query = []): BinaryResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/dns/zones/{zone}/export')
            ->withPathParameters(['project' => $project, 'zone' => $zone])
            ->withQuery($query)
            ->withHeaders(['Accept' => 'text/plain']);

        return $operation->binary();
    }

    /**
     * Show a DNS zone
     *
     * Operation: projects.dns.zones.show
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<DnsZoneData>
     */
    public function find(string $project, string $zone, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/dns/zones/{zone}')
            ->withPathParameters(['project' => $project, 'zone' => $zone])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): DnsZoneData => DnsZoneData::fromArray(self::attributes($resource, true)));
    }

    /**
     * List DNS zones for a project
     *
     * Operation: projects.dns.zones.index
     *
     * @param  array<string, mixed>  $query
     * @return CollectionResult<DnsZoneData>
     */
    public function list(string $project, array $query = []): CollectionResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/dns/zones')
            ->withPathParameters(['project' => $project])
            ->withQuery($query);

        return $operation->collection(static fn (array $resource): DnsZoneData => DnsZoneData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Check live DNS status for a zone
     *
     * Operation: projects.dns.zones.status
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<DnsStatusData>
     */
    public function status(string $project, string $zone, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/dns/zones/{zone}/status')
            ->withPathParameters(['project' => $project, 'zone' => $zone])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): DnsStatusData => DnsStatusData::fromArray(self::attributes($resource, false)));
    }

    /**
     * Update a DNS zone
     *
     * Operation: projects.dns.zones.update
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<DnsZoneData>
     */
    public function update(string $project, string $zone, UpdateZoneData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('PATCH', '/projects/{project}/dns/zones/{zone}')
            ->withPathParameters(['project' => $project, 'zone' => $zone])
            ->withBody([
                'data' => [
                    'type' => 'dns_zones',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): DnsZoneData => DnsZoneData::fromArray(self::attributes($resource, true)));
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
