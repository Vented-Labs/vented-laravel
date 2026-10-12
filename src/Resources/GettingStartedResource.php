<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\ProjectData;
use Vented\Data\UpdateOnboardingData;
use Vented\Results\CollectionResult;
use Vented\Results\NoContentResult;
use Vented\Vented;

final readonly class GettingStartedResource
{
    public function __construct(private Vented $client) {}

    /**
     * Show your getting started guide
     *
     * Operation: account.getting-started.show
     *
     * @param  array<string, mixed>  $query
     * @return CollectionResult<ProjectData>
     */
    public function find(array $query = []): CollectionResult
    {
        $operation = $this->client->operation('GET', '/account/getting-started')
            ->withQuery($query);

        return $operation->collection(static fn (array $resource): ProjectData => ProjectData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Set your onboarding preferences
     *
     * Operation: account.getting-started.update
     *
     * @param  array<string, mixed>  $query
     */
    public function update(UpdateOnboardingData $data, array $query = []): NoContentResult
    {
        $operation = $this->client->operation('PATCH', '/account/getting-started')
            ->withBody([
                'data' => [
                    'type' => 'onboarding_preferences',
                    'attributes' => $data->toArray(),
                ],
            ])
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
