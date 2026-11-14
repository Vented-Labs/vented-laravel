<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\InvoiceData;
use Vented\Results\BinaryResult;
use Vented\Results\CollectionResult;
use Vented\Vented;

final readonly class AccountInvoicesResource
{
    public function __construct(private Vented $client) {}

    /**
     * Download an invoice PDF
     *
     * Operation: billing.invoices.download
     *
     * @param  array<string, mixed>  $query
     */
    public function download(string $invoice, array $query = []): BinaryResult
    {
        $operation = $this->client->operation('GET', '/billing/invoices/{invoice}')
            ->withPathParameters(['invoice' => $invoice])
            ->withQuery($query)
            ->withHeaders(['Accept' => 'application/pdf']);

        return $operation->binary();
    }

    /**
     * List invoices
     *
     * Operation: billing.invoices.index
     *
     * @param  array<string, mixed>  $query
     * @return CollectionResult<InvoiceData>
     */
    public function list(array $query = []): CollectionResult
    {
        $operation = $this->client->operation('GET', '/billing/invoices')
            ->withQuery($query);

        return $operation->collection(static fn (array $resource): InvoiceData => InvoiceData::fromArray(self::attributes($resource, true)));
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
