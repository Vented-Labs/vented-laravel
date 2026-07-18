<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\DeveloperOverviewData;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class DevelopersResource
{
    public function __construct(private Vented $client) {}

    /**
     * Show the Developers overview for a project
     *
     * Operation: projects.developers.index
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<DeveloperOverviewData>
     */
    public function list(string $project, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/developers')
            ->withPathParameters(['project' => $project])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): DeveloperOverviewData => DeveloperOverviewData::fromArray(self::attributes($resource, false)));
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
