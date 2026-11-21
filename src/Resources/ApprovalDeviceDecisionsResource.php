<?php

declare(strict_types=1);

namespace Vented\Resources;

use Vented\Data\ApprovalDecisionData;
use Vented\Results\NoContentResult;
use Vented\Vented;

final readonly class ApprovalDeviceDecisionsResource
{
    public function __construct(private Vented $client) {}

    /**
     * Approve or deny an agent request from this phone
     *
     * Operation: account.approval-devices.decisions.store
     *
     * @param  array<string, mixed>  $query
     */
    public function create(string $device, ApprovalDecisionData $data, array $query = []): NoContentResult
    {
        $operation = $this->client->operation('POST', '/account/approval-devices/{device}/decisions')
            ->withPathParameters(['device' => $device])
            ->withBody([
                'data' => [
                    'type' => 'approval_decisions',
                    'attributes' => $data->toArray(),
                ],
            ])
            ->withQuery($query);

        return $operation->noContent();
    }
}
