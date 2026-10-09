<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\ManagedStackCandidatesData;
use Vented\Data\StoreManagedStackCandidatesData;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class StackCandidatesResource
{
    public function __construct(private Vented $client) {}

    /**
     * Evaluate stack role candidates
     *
     * Operation: projects.stack-candidates.store
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<ManagedStackCandidatesData>
     */
    public function create(string $project, string $environment, StoreManagedStackCandidatesData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/projects/{project}/{environment}/stack-candidates')
            ->withPathParameters(['project' => $project, 'environment' => $environment])
            ->withBody([
                'data' => [
                    'type' => 'managed_stack_candidates',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): ManagedStackCandidatesData => ManagedStackCandidatesData::fromArray(self::attributes($resource, true)));
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
