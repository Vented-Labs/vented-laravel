<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\BillingQuoteData;
use Vented\Data\CreateQuoteData;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class BillingQuotesResource
{
    public function __construct(private Vented $client) {}

    /**
     * Create a billing quote
     *
     * Operation: projects.billing.quotes.store
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<BillingQuoteData>
     */
    public function create(string $project, CreateQuoteData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/projects/{project}/billing/quotes')
            ->withPathParameters(['project' => $project])
            ->withBody([
                'data' => [
                    'type' => 'billing_quotes',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): BillingQuoteData => BillingQuoteData::fromArray(self::attributes($resource, true)));
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
