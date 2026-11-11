<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\ProjectPinData;
use Vented\Results\NoContentResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class ProjectPinsResource
{
    public function __construct(private Vented $client) {}

    /**
     * Pin a project
     *
     * Operation: projects.pin.store
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<ProjectPinData>
     */
    public function create(string $project, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/projects/{project}/pin')
            ->withPathParameters(['project' => $project])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): ProjectPinData => ProjectPinData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Unpin a project
     *
     * Operation: projects.pin.destroy
     *
     * @param  array<string, mixed>  $query
     */
    public function delete(string $project, array $query = []): NoContentResult
    {
        $operation = $this->client->operation('DELETE', '/projects/{project}/pin')
            ->withPathParameters(['project' => $project])
            ->withQuery($query);

        return $operation->noContent();
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
