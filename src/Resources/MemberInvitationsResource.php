<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\ProjectInviteData;
use Vented\Data\StoreInviteData;
use Vented\Results\CollectionResult;
use Vented\Results\NoContentResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class MemberInvitationsResource
{
    public function __construct(private Vented $client) {}

    /**
     * Invite a member to the project
     *
     * Operation: projects.members.invitations.store
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<ProjectInviteData>
     */
    public function create(string $project, StoreInviteData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/projects/{project}/members/invitations')
            ->withPathParameters(['project' => $project])
            ->withBody([
                'data' => [
                    'type' => 'project_invites',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): ProjectInviteData => ProjectInviteData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Cancel a pending invitation
     *
     * Operation: projects.members.invitations.destroy
     *
     * @param  array<string, mixed>  $query
     */
    public function delete(string $project, string $invitation, array $query = []): NoContentResult
    {
        $operation = $this->client->operation('DELETE', '/projects/{project}/members/invitations/{invitation}')
            ->withPathParameters(['project' => $project, 'invitation' => $invitation])
            ->withQuery($query);

        return $operation->noContent();
    }

    /**
     * List pending project invitations
     *
     * Operation: projects.members.invitations.index
     *
     * @param  array<string, mixed>  $query
     * @return CollectionResult<ProjectInviteData>
     */
    public function list(string $project, array $query = []): CollectionResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/members/invitations')
            ->withPathParameters(['project' => $project])
            ->withQuery($query);

        return $operation->collection(static fn (array $resource): ProjectInviteData => ProjectInviteData::fromArray(self::attributes($resource, true)));
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
