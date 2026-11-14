<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\SshKeyData;
use Vented\Data\StoreSshKeyData;
use Vented\Results\CollectionResult;
use Vented\Results\NoContentResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class AccountSshKeysResource
{
    public function __construct(private Vented $client) {}

    /**
     * Add an SSH key
     *
     * Operation: account.ssh-keys.store
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<SshKeyData>
     */
    public function create(StoreSshKeyData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/account/ssh-keys')
            ->withBody([
                'data' => [
                    'type' => 'ssh_keys',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): SshKeyData => SshKeyData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Remove an SSH key
     *
     * Operation: account.ssh-keys.destroy
     *
     * @param  array<string, mixed>  $query
     */
    public function delete(string $key, array $query = []): NoContentResult
    {
        $operation = $this->client->operation('DELETE', '/account/ssh-keys/{key}')
            ->withPathParameters(['key' => $key])
            ->withQuery($query);

        return $operation->noContent();
    }

    /**
     * List your SSH keys
     *
     * Operation: account.ssh-keys.index
     *
     * @param  array<string, mixed>  $query
     * @return CollectionResult<SshKeyData>
     */
    public function list(array $query = []): CollectionResult
    {
        $operation = $this->client->operation('GET', '/account/ssh-keys')
            ->withQuery($query);

        return $operation->collection(static fn (array $resource): SshKeyData => SshKeyData::fromArray(self::attributes($resource, true)));
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
