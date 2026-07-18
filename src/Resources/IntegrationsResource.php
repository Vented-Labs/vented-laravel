<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\IntegrationData;
use Vented\Data\StoreIntegrationData;
use Vented\Data\UpdateIntegrationData;
use Vented\Results\CollectionResult;
use Vented\Results\NoContentResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class IntegrationsResource
{
    public function __construct(private Vented $client) {}

    /**
     * Create an integration
     *
     * Operation: projects.integrations.store
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<IntegrationData>
     */
    public function create(string $project, StoreIntegrationData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/projects/{project}/integrations')
            ->withPathParameters(['project' => $project])
            ->withBody([
                'data' => [
                    'type' => 'integrations',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): IntegrationData => IntegrationData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Delete an integration
     *
     * Operation: projects.integrations.destroy
     *
     * @param  array<string, mixed>  $query
     */
    public function delete(string $project, string $integration, array $query = []): NoContentResult
    {
        $operation = $this->client->operation('DELETE', '/projects/{project}/integrations/{integration}')
            ->withPathParameters(['project' => $project, 'integration' => $integration])
            ->withQuery($query);

        return $operation->noContent();
    }

    /**
     * Show an integration
     *
     * Operation: projects.integrations.show
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<IntegrationData>
     */
    public function find(string $project, string $integration, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/integrations/{integration}')
            ->withPathParameters(['project' => $project, 'integration' => $integration])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): IntegrationData => IntegrationData::fromArray(self::attributes($resource, true)));
    }

    /**
     * List integrations for a project
     *
     * Operation: projects.integrations.index
     *
     * @param  array<string, mixed>  $query
     * @return CollectionResult<IntegrationData>
     */
    public function list(string $project, array $query = []): CollectionResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/integrations')
            ->withPathParameters(['project' => $project])
            ->withQuery($query);

        return $operation->collection(static fn (array $resource): IntegrationData => IntegrationData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Update an integration
     *
     * Operation: projects.integrations.update
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<IntegrationData>
     */
    public function update(string $project, string $integration, UpdateIntegrationData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('PATCH', '/projects/{project}/integrations/{integration}')
            ->withPathParameters(['project' => $project, 'integration' => $integration])
            ->withBody([
                'data' => [
                    'type' => 'integrations',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): IntegrationData => IntegrationData::fromArray(self::attributes($resource, true)));
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
