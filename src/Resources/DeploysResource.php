<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\DeployData;
use Vented\Data\StoreDeployData;
use Vented\Results\PaginatedResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class DeploysResource
{
    public function __construct(private Vented $client) {}

    /**
     * Fire a new deploy
     *
     * Operation: projects.deploys.store
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<DeployData>
     */
    public function create(string $project, StoreDeployData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/projects/{project}/deploys')
            ->withPathParameters(['project' => $project])
            ->withBody([
                'data' => [
                    'type' => 'deploys',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): DeployData => DeployData::fromArray(self::attributes($resource, true)));
    }

    /**
     * List deploys for a project
     *
     * Operation: projects.deploys.index
     *
     * @param  array<string, mixed>  $query
     * @return PaginatedResult<DeployData>
     */
    public function list(string $project, array $query = []): PaginatedResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/deploys')
            ->withPathParameters(['project' => $project])
            ->withQuery($query);

        return $operation->paginated(static fn (array $resource): DeployData => DeployData::fromArray(self::attributes($resource, true)));
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
