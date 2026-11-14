<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\SupportOverviewData;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class SupportResource
{
    public function __construct(private Vented $client) {}

    /**
     * Support center overview
     *
     * Operation: support.overview
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<SupportOverviewData>
     */
    public function find(array $query = []): ResourceResult
    {
        $operation = $this->client->operation('GET', '/support')
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): SupportOverviewData => SupportOverviewData::fromArray(self::attributes($resource, true)));
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
