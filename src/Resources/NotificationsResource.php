<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\NotificationData;
use Vented\Results\CollectionResult;
use Vented\Results\NoContentResult;
use Vented\Vented;

final readonly class NotificationsResource
{
    public function __construct(private Vented $client) {}

    /**
     * List your notifications
     *
     * Operation: notifications.index
     *
     * @param  array<string, mixed>  $query
     * @return CollectionResult<NotificationData>
     */
    public function list(array $query = []): CollectionResult
    {
        $operation = $this->client->operation('GET', '/account/notifications')
            ->withQuery($query);

        return $operation->collection(static fn (array $resource): NotificationData => NotificationData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Mark a notification as read
     *
     * Operation: notifications.read
     *
     * @param  array<string, mixed>  $query
     */
    public function read(string $notification, array $query = []): NoContentResult
    {
        $operation = $this->client->operation('POST', '/account/notifications/{notification}/read')
            ->withPathParameters(['notification' => $notification])
            ->withQuery($query);

        return $operation->noContent();
    }

    /**
     * Mark every notification as read
     *
     * Operation: notifications.read-all
     *
     * @param  array<string, mixed>  $query
     */
    public function readAll(array $query = []): NoContentResult
    {
        $operation = $this->client->operation('POST', '/account/notifications/read-all')
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
