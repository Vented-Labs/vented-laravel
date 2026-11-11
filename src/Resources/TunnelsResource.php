<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\StoreTunnelData;
use Vented\Data\TunnelAgentSetupData;
use Vented\Data\TunnelData;
use Vented\Results\CollectionResult;
use Vented\Results\NoContentResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class TunnelsResource
{
    public function __construct(private Vented $client) {}

    /**
     * Show how an agent connects to the tunnel server
     *
     * Operation: projects.tunnels.agent-setup
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<TunnelAgentSetupData>
     */
    public function agentSetup(string $project, string $environment, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/{environment}/tunnels/agent-setup')
            ->withPathParameters(['project' => $project, 'environment' => $environment])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): TunnelAgentSetupData => TunnelAgentSetupData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Create a tunnel
     *
     * Operation: projects.tunnels.store
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<TunnelData>
     */
    public function create(string $project, string $environment, StoreTunnelData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/projects/{project}/{environment}/tunnels')
            ->withPathParameters(['project' => $project, 'environment' => $environment])
            ->withBody([
                'data' => [
                    'type' => 'tunnels',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): TunnelData => TunnelData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Remove a tunnel
     *
     * Operation: projects.tunnels.destroy
     *
     * @param  array<string, mixed>  $query
     */
    public function delete(string $project, string $environment, string $tunnel, array $query = []): NoContentResult
    {
        $operation = $this->client->operation('DELETE', '/projects/{project}/{environment}/tunnels/{tunnel}')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'tunnel' => $tunnel])
            ->withQuery($query);

        return $operation->noContent();
    }

    /**
     * Show a tunnel
     *
     * Operation: projects.tunnels.show
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<TunnelData>
     */
    public function find(string $project, string $environment, string $tunnel, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/{environment}/tunnels/{tunnel}')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'tunnel' => $tunnel])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): TunnelData => TunnelData::fromArray(self::attributes($resource, true)));
    }

    /**
     * List tunnels for an environment
     *
     * Operation: projects.tunnels.index
     *
     * @param  array<string, mixed>  $query
     * @return CollectionResult<TunnelData>
     */
    public function list(string $project, string $environment, array $query = []): CollectionResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/{environment}/tunnels')
            ->withPathParameters(['project' => $project, 'environment' => $environment])
            ->withQuery($query);

        return $operation->collection(static fn (array $resource): TunnelData => TunnelData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Start a tunnel
     *
     * Operation: projects.tunnels.start
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<TunnelData>
     */
    public function start(string $project, string $environment, string $tunnel, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/projects/{project}/{environment}/tunnels/{tunnel}/start')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'tunnel' => $tunnel])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): TunnelData => TunnelData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Stop a tunnel
     *
     * Operation: projects.tunnels.stop
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<TunnelData>
     */
    public function stop(string $project, string $environment, string $tunnel, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/projects/{project}/{environment}/tunnels/{tunnel}/stop')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'tunnel' => $tunnel])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): TunnelData => TunnelData::fromArray(self::attributes($resource, true)));
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
