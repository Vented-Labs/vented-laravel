<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\DeployTriggerData;
use Vented\Data\StoreDeployTriggerData;
use Vented\Data\UpdateDeployTriggerData;
use Vented\Results\CollectionResult;
use Vented\Results\NoContentResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class DeployTriggersResource
{
    public function __construct(private Vented $client) {}

    /**
     * Create a deploy trigger
     *
     * Operation: projects.deploy-triggers.store
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<DeployTriggerData>
     */
    public function create(string $project, string $environment, StoreDeployTriggerData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/projects/{project}/{environment}/deploy-triggers')
            ->withPathParameters(['project' => $project, 'environment' => $environment])
            ->withBody([
                'data' => [
                    'type' => 'deploy_triggers',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): DeployTriggerData => DeployTriggerData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Delete a deploy trigger
     *
     * Operation: projects.deploy-triggers.destroy
     *
     * @param  array<string, mixed>  $query
     */
    public function delete(string $project, string $environment, string $deployTrigger, array $query = []): NoContentResult
    {
        $operation = $this->client->operation('DELETE', '/projects/{project}/{environment}/deploy-triggers/{deployTrigger}')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'deployTrigger' => $deployTrigger])
            ->withQuery($query);

        return $operation->noContent();
    }

    /**
     * List deploy triggers for an environment
     *
     * Operation: projects.deploy-triggers.index
     *
     * @param  array<string, mixed>  $query
     * @return CollectionResult<DeployTriggerData>
     */
    public function list(string $project, string $environment, array $query = []): CollectionResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/{environment}/deploy-triggers')
            ->withPathParameters(['project' => $project, 'environment' => $environment])
            ->withQuery($query);

        return $operation->collection(static fn (array $resource): DeployTriggerData => DeployTriggerData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Update a deploy trigger
     *
     * Operation: projects.deploy-triggers.update
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<DeployTriggerData>
     */
    public function update(string $project, string $environment, string $deployTrigger, UpdateDeployTriggerData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('PATCH', '/projects/{project}/{environment}/deploy-triggers/{deployTrigger}')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'deployTrigger' => $deployTrigger])
            ->withBody([
                'data' => [
                    'type' => 'deploy_triggers',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): DeployTriggerData => DeployTriggerData::fromArray(self::attributes($resource, true)));
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
