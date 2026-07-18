<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\DnsRecordData;
use Vented\Data\DnsZoneData;
use Vented\Data\StoreRecordData;
use Vented\Data\UpdateRecordData;
use Vented\Results\NoContentResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class DnsZoneRecordsResource
{
    public function __construct(private Vented $client) {}

    /**
     * Create a DNS record
     *
     * Operation: projects.dns.zones.records.store
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<DnsRecordData>
     */
    public function create(string $project, string $zone, StoreRecordData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/projects/{project}/dns/zones/{zone}/records')
            ->withPathParameters(['project' => $project, 'zone' => $zone])
            ->withBody([
                'data' => [
                    'type' => 'dns_records',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): DnsRecordData => DnsRecordData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Delete a DNS record
     *
     * Operation: projects.dns.zones.records.destroy
     *
     * @param  array<string, mixed>  $query
     */
    public function delete(string $project, string $zone, string $record, array $query = []): NoContentResult
    {
        $operation = $this->client->operation('DELETE', '/projects/{project}/dns/zones/{zone}/records/{record}')
            ->withPathParameters(['project' => $project, 'zone' => $zone, 'record' => $record])
            ->withQuery($query);

        return $operation->noContent();
    }

    /**
     * List records for a zone
     *
     * Operation: projects.dns.zones.records.index
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<DnsZoneData>
     */
    public function list(string $project, string $zone, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/dns/zones/{zone}/records')
            ->withPathParameters(['project' => $project, 'zone' => $zone])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): DnsZoneData => DnsZoneData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Update a DNS record
     *
     * Operation: projects.dns.zones.records.update
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<DnsRecordData>
     */
    public function update(string $project, string $zone, string $record, UpdateRecordData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('PATCH', '/projects/{project}/dns/zones/{zone}/records/{record}')
            ->withPathParameters(['project' => $project, 'zone' => $zone, 'record' => $record])
            ->withBody([
                'data' => [
                    'type' => 'dns_records',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): DnsRecordData => DnsRecordData::fromArray(self::attributes($resource, true)));
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
