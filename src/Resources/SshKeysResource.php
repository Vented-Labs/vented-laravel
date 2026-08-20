<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\EnvironmentSshKeyData;
use Vented\Data\StoreEnvironmentSshKeyData;
use Vented\Results\CollectionResult;
use Vented\Results\NoContentResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class SshKeysResource
{
    public function __construct(private Vented $client) {}

    /**
     * Grant an SSH key access to an environment
     *
     * Operation: projects.ssh-keys.store
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<EnvironmentSshKeyData>
     */
    public function create(string $project, string $environment, StoreEnvironmentSshKeyData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/projects/{project}/{environment}/ssh-keys')
            ->withPathParameters(['project' => $project, 'environment' => $environment])
            ->withBody([
                'data' => [
                    'type' => 'environment_ssh_keys',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): EnvironmentSshKeyData => EnvironmentSshKeyData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Revoke an SSH key from an environment
     *
     * Operation: projects.ssh-keys.destroy
     *
     * @param  array<string, mixed>  $query
     */
    public function delete(string $project, string $environment, string $sshKey, array $query = []): NoContentResult
    {
        $operation = $this->client->operation('DELETE', '/projects/{project}/{environment}/ssh-keys/{sshKey}')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'sshKey' => $sshKey])
            ->withQuery($query);

        return $operation->noContent();
    }

    /**
     * List SSH keys with deploy access to an environment
     *
     * Operation: projects.ssh-keys.index
     *
     * @param  array<string, mixed>  $query
     * @return CollectionResult<EnvironmentSshKeyData>
     */
    public function list(string $project, string $environment, array $query = []): CollectionResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/{environment}/ssh-keys')
            ->withPathParameters(['project' => $project, 'environment' => $environment])
            ->withQuery($query);

        return $operation->collection(static fn (array $resource): EnvironmentSshKeyData => EnvironmentSshKeyData::fromArray(self::attributes($resource, true)));
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
