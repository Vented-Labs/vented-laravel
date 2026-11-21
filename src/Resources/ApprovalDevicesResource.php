<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\ApprovalDeviceData;
use Vented\Data\StoreApprovalDeviceData;
use Vented\Results\NoContentResult;
use Vented\Results\ResourceResult;
use Vented\Vented;

final readonly class ApprovalDevicesResource
{
    public function __construct(private Vented $client) {}

    /**
     * Enroll this phone to approve agent requests
     *
     * Operation: account.approval-devices.store
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<ApprovalDeviceData>
     */
    public function create(StoreApprovalDeviceData $data, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('POST', '/account/approval-devices')
            ->withBody([
                'data' => [
                    'type' => 'approval_devices',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): ApprovalDeviceData => ApprovalDeviceData::fromArray(self::attributes($resource, true)));
    }

    /**
     * Remove an enrolled phone
     *
     * Operation: account.approval-devices.destroy
     *
     * @param  array<string, mixed>  $query
     */
    public function delete(string $device, array $query = []): NoContentResult
    {
        $operation = $this->client->operation('DELETE', '/account/approval-devices/{device}')
            ->withPathParameters(['device' => $device])
            ->withQuery($query);

        return $operation->noContent();
    }

    /**
     * Show an enrolled phone
     *
     * Operation: account.approval-devices.show
     *
     * @param  array<string, mixed>  $query
     * @return ResourceResult<ApprovalDeviceData>
     */
    public function find(string $device, array $query = []): ResourceResult
    {
        $operation = $this->client->operation('GET', '/account/approval-devices/{device}')
            ->withPathParameters(['device' => $device])
            ->withQuery($query);

        return $operation->resource(static fn (array $resource): ApprovalDeviceData => ApprovalDeviceData::fromArray(self::attributes($resource, true)));
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
