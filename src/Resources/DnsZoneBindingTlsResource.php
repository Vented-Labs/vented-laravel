<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\AppBindingData;
use Vented\Data\UpdateBindingTlsData;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class DnsZoneBindingTlsResource
{
    public function __construct(private Vented $client) {}

    /**
     * Set an app binding's TLS
     *
     * Operation: projects.dns.zones.bindings.tls.update
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<AppBindingData>
     */
    public function update(string $project, string $zone, string $binding, UpdateBindingTlsData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('PUT', '/projects/{project}/dns/zones/{zone}/bindings/{binding}/tls')
            ->withPathParameters(['project' => $project, 'zone' => $zone, 'binding' => $binding])
            ->withBody([
                'data' => [
                    'type' => 'app_binding_tls',
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
