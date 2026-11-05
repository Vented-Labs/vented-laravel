<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\OrganizationData;
use Vented\Results\CollectionResult;
use Vented\Vented;

final readonly class OrganizationSettingsResource
{
    public function __construct(private Vented $client) {}

    /**
     * Show organization settings
     *
     * Operation: account.organizations.settings
     *
     * @param  array<string, mixed>  $query
     * @return CollectionResult<OrganizationData>
     */
    public function list(string $organization, array $query = []): CollectionResult
    {
        $operation = $this->client->operation('GET', '/organizations/{organization}/settings')
            ->withPathParameters(['organization' => $organization])
            ->withQuery($query);

        return $operation->collection(static fn (array $resource): OrganizationData => OrganizationData::fromArray(self::attributes($resource, true)));
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
