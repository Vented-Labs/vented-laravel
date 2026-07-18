<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\ProjectSshKeyData;
use Vented\Data\StoreProjectSshKeyData;
use Vented\Results\CollectionResult;
use Vented\Results\NoContentResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class SshKeysResource
{
    public function __construct(private Vented $client) {}

    /**
     * Grant a SSH key access to a project
     *
     * Operation: projects.ssh-keys.store
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<ProjectSshKeyData>
     */
    public function create(string $project, StoreProjectSshKeyData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/projects/{project}/ssh-keys')
            ->withPathParameters(['project' => $project])
            ->withBody([
                'data' => [
                    'type' => 'project_ssh_keys',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): ProjectSshKeyData => ProjectSshKeyData::fromArray(self::attributes($resource, false)));
    }

    /**
     * Revoke a SSH key from a project
     *
     * Operation: projects.ssh-keys.destroy
     *
     * @param  array<string, mixed>  $query
     */
    public function delete(string $project, string $sshKey, array $query = []): NoContentResult
    {
        $operation = $this->client->operation('DELETE', '/projects/{project}/ssh-keys/{sshKey}')
            ->withPathParameters(['project' => $project, 'sshKey' => $sshKey])
            ->withQuery($query);

        return $operation->noContent();
    }

    /**
     * List SSH keys with deploy access to a project
     *
     * Operation: projects.ssh-keys.index
     *
     * @param  array<string, mixed>  $query
     * @return CollectionResult<ProjectSshKeyData>
     */
    public function list(string $project, array $query = []): CollectionResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/ssh-keys')
            ->withPathParameters(['project' => $project])
            ->withQuery($query);

        return $operation->collection(static fn (array $resource): ProjectSshKeyData => ProjectSshKeyData::fromArray(self::attributes($resource, false)));
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
