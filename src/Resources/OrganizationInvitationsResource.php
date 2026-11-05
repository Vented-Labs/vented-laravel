<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\OrganizationInviteData;
use Vented\Data\StoreOrganizationInviteData;
use Vented\Results\NoContentResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class OrganizationInvitationsResource
{
    public function __construct(private Vented $client) {}

    /**
     * Invite someone to an organization
     *
     * Operation: account.organizations.invitations.store
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<OrganizationInviteData>
     */
    public function create(string $organization, StoreOrganizationInviteData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/organizations/{organization}/invitations')
            ->withPathParameters(['organization' => $organization])
            ->withBody([
                'data' => [
                    'type' => 'organization_invites',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): OrganizationInviteData => OrganizationInviteData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Cancel an organization invitation
     *
     * Operation: account.organizations.invitations.destroy
     *
     * @param  array<string, mixed>  $query
     */
    public function delete(string $organization, string $invitation, array $query = []): NoContentResult
    {
        $operation = $this->client->operation('DELETE', '/organizations/{organization}/invitations/{invitation}')
            ->withPathParameters(['organization' => $organization, 'invitation' => $invitation])
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
