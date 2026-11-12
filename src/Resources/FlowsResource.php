<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\FlowData;
use Vented\Data\UpdateFlowData;
use Vented\Results\NoContentResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class FlowsResource
{
    public function __construct(private Vented $client) {}

    /**
     * Discard saved flow answers
     *
     * Operation: account.flows.destroy
     *
     * @param  array<string, mixed>  $query
     */
    public function delete(string $flow, array $query = []): NoContentResult
    {
        $operation = $this->client->operation('DELETE', '/account/flows/{flow}')
            ->withPathParameters(['flow' => $flow])
            ->withQuery($query);

        return $operation->noContent();
    }

    /**
     * Show a flow
     *
     * Operation: account.flows.show
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<FlowData>
     */
    public function find(string $flow, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('GET', '/account/flows/{flow}')
            ->withPathParameters(['flow' => $flow])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): FlowData => FlowData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Save a flow step
     *
     * Operation: account.flows.update
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<FlowData>
     */
    public function update(string $flow, UpdateFlowData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('PATCH', '/account/flows/{flow}')
            ->withPathParameters(['flow' => $flow])
            ->withBody([
                'data' => [
                    'type' => 'flows',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): FlowData => FlowData::fromArray(self::attributes($resource, true)));
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
