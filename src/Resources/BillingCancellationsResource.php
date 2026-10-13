<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\BillingOperationData;
use Vented\Data\CancelSubscriptionData;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class BillingCancellationsResource
{
    public function __construct(private Vented $client) {}

    /**
     * Cancel project billing
     *
     * Operation: projects.billing.cancellations.store
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<BillingOperationData>
     */
    public function create(string $project, CancelSubscriptionData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/projects/{project}/billing/cancellations')
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
