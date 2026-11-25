<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\BuildData;
use Vented\Results\PaginatedResult;
use Vented\Vented;

final readonly class BuildConfigBuildsResource
{
    public function __construct(private Vented $client) {}

    /**
     * List a build configuration's builds
     *
     * Operation: projects.build-configs.builds.index
     *
     * @param  array<string, mixed>  $query
     * @return PaginatedResult<BuildData>
     */
    public function list(string $project, string $environment, string $buildConfig, array $query = []): PaginatedResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/{environment}/build-configs/{buildConfig}/builds')
            ->withPathParameters(['project' => $project, 'environment' => $environment, 'buildConfig' => $buildConfig])
            ->withQuery($query);

        return $operation->paginated(static fn (array $resource): BuildData => BuildData::fromArray(self::attributes($resource, true)));
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
