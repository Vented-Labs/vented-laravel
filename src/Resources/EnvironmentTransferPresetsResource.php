<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\EnvironmentTransferPresetData;
use Vented\Data\StoreEnvironmentTransferPresetData;
use Vented\Data\UpdateEnvironmentTransferPresetData;
use Vented\Results\NoContentResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class EnvironmentTransferPresetsResource
{
    public function __construct(private Vented $client) {}

    /**
     * Create an environment transfer preset
     *
     * Operation: projects.environment-transfer-presets.store
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<EnvironmentTransferPresetData>
     */
    public function create(string $project, string $environment, StoreEnvironmentTransferPresetData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/projects/{project}/{environment}/transfer-presets')
            ->withPathParameters(['project' => $project, 'environment' => $environment])
            ->withBody([
                'data' => [
                    'type' => 'environment_transfer_presets',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): EnvironmentTransferPresetData => EnvironmentTransferPresetData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Delete an environment transfer preset
     *
     * Operation: projects.environment-transfer-presets.destroy
     *
     * @param  array<string, mixed>  $query
     */
    public function delete(string $project, string $environment, string $transferPreset, array $query = []): NoContentResult
    {
        $operation = $this->client->operation('DELETE', '/projects/{project}/{environment}/transfer-presets/{transferPreset}')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'transferPreset' => $transferPreset])
            ->withQuery($query);

        return $operation->noContent();
    }

    /**
     * Update an environment transfer preset
     *
     * Operation: projects.environment-transfer-presets.update
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<EnvironmentTransferPresetData>
     */
    public function update(string $project, string $environment, string $transferPreset, UpdateEnvironmentTransferPresetData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('PATCH', '/projects/{project}/{environment}/transfer-presets/{transferPreset}')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'transferPreset' => $transferPreset])
            ->withBody([
                'data' => [
                    'type' => 'environment_transfer_presets',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): EnvironmentTransferPresetData => EnvironmentTransferPresetData::fromArray(self::attributes($resource, true)));
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
