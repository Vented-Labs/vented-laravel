<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\ProjectMemberData;
use Vented\Results\CollectionResult;
use Vented\Results\NoContentResult;
use Vented\Vented;

final readonly class MembersResource
{
    public function __construct(private Vented $client) {}

    /**
     * Remove a member from the project
     *
     * Operation: projects.members.destroy
     *
     * @param  array<string, mixed>  $query
     */
    public function delete(string $project, string $member, array $query = []): NoContentResult
    {
        $operation = $this->client->operation('DELETE', '/projects/{project}/members/{member}')
            ->withPathParameters(['project' => $project, 'member' => $member])
            ->withQuery($query);

        return $operation->noContent();
    }

    /**
     * List project members
     *
     * Operation: projects.members.index
     *
     * @param  array<string, mixed>  $query
     * @return CollectionResult<ProjectMemberData>
     */
    public function list(string $project, array $query = []): CollectionResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/members')
            ->withPathParameters(['project' => $project])
            ->withQuery($query);

        return $operation->collection(static fn (array $resource): ProjectMemberData => ProjectMemberData::fromArray(self::attributes($resource, true)));
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
