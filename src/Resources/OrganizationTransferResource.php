<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\OrganizationData;
use Vented\Results\NoContentResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class OrganizationTransferResource
{
    public function __construct(private Vented $client) {}

    /**
     * Accept an organization transfer
     *
     * Operation: account.organizations.transfer.accept
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<OrganizationData>
     */
    public function accept(string $organization, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/organizations/{organization}/transfer/accept')
            ->withPathParameters(['organization' => $organization])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): OrganizationData => OrganizationData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Cancel or decline an organization transfer
     *
     * Operation: account.organizations.transfer.cancel
     *
     * @param  array<string, mixed>  $query
     */
    public function cancel(string $organization, array $query = []): NoContentResult
    {
        $operation = $this->client->operation('DELETE', '/organizations/{organization}/transfer')
            ->withPathParameters(['organization' => $organization])
            ->withQuery($query);

        return $operation->noContent();
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
