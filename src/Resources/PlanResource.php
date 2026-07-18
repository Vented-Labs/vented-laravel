<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\PlanData;
use Vented\Data\PlanUsageDetailData;
use Vented\Data\SelectPlanData;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class PlanResource
{
    public function __construct(private Vented $client) {}

    /**
     * Show a project's plan & usage summary
     *
     * Operation: projects.plan.show
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<PlanData>
     */
    public function find(string $project, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/plan')
            ->withPathParameters(['project' => $project])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): PlanData => PlanData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Select a plan
     *
     * Operation: projects.plan.update
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<PlanData>
     */
    public function update(string $project, SelectPlanData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('PATCH', '/projects/{project}/plan')
            ->withPathParameters(['project' => $project])
            ->withBody([
                'data' => [
                    'type' => 'plans',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): PlanData => PlanData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Project plan usage detail
     *
     * Operation: projects.plan.usage
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<PlanUsageDetailData>
     */
    public function usage(string $project, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('GET', '/projects/{project}/plan/usage')
            ->withPathParameters(['project' => $project])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): PlanUsageDetailData => PlanUsageDetailData::fromArray(self::attributes($resource, true)));
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
