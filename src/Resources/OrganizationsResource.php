<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\OrganizationData;
use Vented\Data\StoreOrganizationData;
use Vented\Data\TransferOrganizationData;
use Vented\Data\UpdateOrganizationData;
use Vented\Results\CollectionResult;
use Vented\Results\NoContentResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class OrganizationsResource
{
    public function __construct(private Vented $client) {}

    /**
     * Create an organization
     *
     * Operation: account.organizations.store
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<OrganizationData>
     */
    public function create(StoreOrganizationData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/organizations')
            ->withBody([
                'data' => [
                    'type' => 'organizations',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): OrganizationData => OrganizationData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Delete an organization
     *
     * Operation: account.organizations.destroy
     *
     * @param  array<string, mixed>  $query
     */
    public function delete(string $organization, array $query = []): NoContentResult
    {
        $operation = $this->client->operation('DELETE', '/organizations/{organization}')
            ->withPathParameters(['organization' => $organization])
            ->withQuery($query);

        return $operation->noContent();
    }

    /**
     * Show an organization
     *
     * Operation: account.organizations.show
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<OrganizationData>
     */
    public function find(string $organization, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('GET', '/organizations/{organization}')
            ->withPathParameters(['organization' => $organization])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): OrganizationData => OrganizationData::fromArray(self::attributes($resource, true)));
    }

    /**
     * List your organizations
     *
     * Operation: account.organizations.index
     *
     * @param  array<string, mixed>  $query
     * @return CollectionResult<OrganizationData>
     */
    public function list(array $query = []): CollectionResult
    {
        $operation = $this->client->operation('GET', '/organizations')
            ->withQuery($query);

        return $operation->collection(static fn (array $resource): OrganizationData => OrganizationData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Offer an organization to another member
     *
     * Operation: account.organizations.transfer
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<OrganizationData>
     */
    public function transfer(string $organization, TransferOrganizationData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/organizations/{organization}/transfer')
            ->withPathParameters(['organization' => $organization])
            ->withBody([
                'data' => [
                    'type' => 'organizations',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): OrganizationData => OrganizationData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Update an organization
     *
     * Operation: account.organizations.update
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<OrganizationData>
     */
    public function update(string $organization, UpdateOrganizationData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('PATCH', '/organizations/{organization}')
            ->withPathParameters(['organization' => $organization])
            ->withBody([
                'data' => [
                    'type' => 'organizations',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): OrganizationData => OrganizationData::fromArray(self::attributes($resource, true)));
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
