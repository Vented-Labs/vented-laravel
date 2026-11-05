<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\OrganizationMemberData;
use Vented\Data\UpdateOrganizationMemberData;
use Vented\Results\CollectionResult;
use Vented\Results\NoContentResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class OrganizationMembersResource
{
    public function __construct(private Vented $client) {}

    /**
     * Remove someone from an organization
     *
     * Operation: account.organizations.members.destroy
     *
     * @param  array<string, mixed>  $query
     */
    public function delete(string $organization, string $member, array $query = []): NoContentResult
    {
        $operation = $this->client->operation('DELETE', '/organizations/{organization}/members/{member}')
            ->withPathParameters(['organization' => $organization, 'member' => $member])
            ->withQuery($query);

        return $operation->noContent();
    }

    /**
     * List organization members
     *
     * Operation: account.organizations.members.index
     *
     * @param  array<string, mixed>  $query
     * @return CollectionResult<OrganizationMemberData>
     */
    public function list(string $organization, array $query = []): CollectionResult
    {
        $operation = $this->client->operation('GET', '/organizations/{organization}/members')
            ->withPathParameters(['organization' => $organization])
            ->withQuery($query);

        return $operation->collection(static fn (array $resource): OrganizationMemberData => OrganizationMemberData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Change a member's role or project access
     *
     * Operation: account.organizations.members.update
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<OrganizationMemberData>
     */
    public function update(string $organization, string $member, UpdateOrganizationMemberData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('PATCH', '/organizations/{organization}/members/{member}')
            ->withPathParameters(['organization' => $organization, 'member' => $member])
            ->withBody([
                'data' => [
                    'type' => 'organization_members',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): OrganizationMemberData => OrganizationMemberData::fromArray(self::attributes($resource, true)));
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
