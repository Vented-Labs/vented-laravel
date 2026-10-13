<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\ProjectInvoiceData;
use Vented\Results\BinaryResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class BillingInvoicesResource
{
    public function __construct(private Vented $client) {}

    /**
     * Download a project invoice
     *
     * Operation: projects.billing.invoices.download
     *
     * @param  array<string, mixed>  $query
     */
    public function download(string $project, string $invoice, array $query = []): BinaryResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/billing/invoices/{invoice}/download')
            ->withPathParameters(['project' => $project, 'invoice' => $invoice])
            ->withQuery($query)
            ->withHeaders(['Accept' => 'application/pdf']);

        return $operation->binary();
    }

    /**
     * Show a project invoice
     *
     * Operation: projects.billing.invoices.show
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<ProjectInvoiceData>
     */
    public function find(string $project, string $invoice, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/billing/invoices/{invoice}')
            ->withPathParameters(['project' => $project, 'invoice' => $invoice])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): ProjectInvoiceData => ProjectInvoiceData::fromArray(self::attributes($resource, true)));
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
