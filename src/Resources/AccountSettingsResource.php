<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\UpdateAccountSettingsData;
use Vented\Data\UserSettingsData;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class AccountSettingsResource
{
    public function __construct(private Vented $client) {}

    /**
     * Show account settings
     *
     * Operation: account.settings.show
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<UserSettingsData>
     */
    public function get(array $query = []): ResourceResult
    {
        $operation = $this->client->operation('GET', '/account/settings')
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): UserSettingsData => UserSettingsData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Update account settings
     *
     * Operation: account.settings.update
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<UserSettingsData>
     */
    public function update(UpdateAccountSettingsData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('PATCH', '/account/settings')
            ->withBody([
                'data' => [
                    'type' => 'user_settings',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): UserSettingsData => UserSettingsData::fromArray(self::attributes($resource, true)));
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
