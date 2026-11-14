<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\UserTwoFactorData;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class TwoFactorResource
{
    public function __construct(private Vented $client) {}

    /**
     * Show two-factor authentication settings
     *
     * Operation: account.two-factor.show
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<UserTwoFactorData>
     */
    public function find(array $query = []): ResourceResult
    {
        $operation = $this->client->operation('GET', '/account/two-factor')
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): UserTwoFactorData => UserTwoFactorData::fromArray(self::attributes($resource, true)));
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
