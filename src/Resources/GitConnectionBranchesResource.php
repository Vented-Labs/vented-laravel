<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\GitRemoteBranchData;
use Vented\Results\CollectionResult;
use Vented\Vented;

final readonly class GitConnectionBranchesResource
{
    public function __construct(private Vented $client) {}

    /**
     * List a repository's branches
     *
     * Operation: projects.git-connections.branches
     *
     * @param  array<string, mixed>  $query
     * @return CollectionResult<GitRemoteBranchData>
     */
    public function list(string $project, string $gitConnection, array $query = []): CollectionResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/git-connections/{gitConnection}/branches')
            ->withPathParameters(['project' => $project, 'gitConnection' => $gitConnection])
            ->withQuery($query);

        return $operation->collection(static fn (array $resource): GitRemoteBranchData => GitRemoteBranchData::fromArray(self::attributes($resource, false)));
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
