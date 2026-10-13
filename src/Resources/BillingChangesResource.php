<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\BillingOperationData;
use Vented\Data\CommitQuoteData;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class BillingChangesResource
{
    public function __construct(private Vented $client) {}

    /**
     * Commit a billing quote
     *
     * Operation: projects.billing.changes.store
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<BillingOperationData>
     */
    public function create(string $project, CommitQuoteData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/projects/{project}/billing/changes')
            ->withPathParameters(['project' => $project])
            ->withBody([
                'data' => [
                    'type' => 'billing_operations',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): BillingOperationData => BillingOperationData::fromArray(self::attributes($resource, true)));
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
