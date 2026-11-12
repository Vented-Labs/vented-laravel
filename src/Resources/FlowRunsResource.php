<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\FlowRunData;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class FlowRunsResource
{
    public function __construct(private Vented $client) {}

    /**
     * Carry out the next stage of a flow
     *
     * Operation: account.flows.runs.store
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<FlowRunData>
     */
    public function create(string $flow, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/account/flows/{flow}/runs')
            ->withPathParameters(['flow' => $flow])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): FlowRunData => FlowRunData::fromArray(self::attributes($resource, true)));
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
