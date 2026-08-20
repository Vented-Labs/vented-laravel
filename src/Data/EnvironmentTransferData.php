<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\EnvironmentTransferSecretPolicy;
use Vented\Enums\EnvironmentTransferStatus;

final readonly class EnvironmentTransferData
{
    /**
     * @param  list<EnvironmentTransferItemData>  $items
     */
    public function __construct(
        public bool $can_apply,
        public bool $can_cancel,
        public bool $can_update,
        public int $completed_items,
        public string $created_at,
        public ?string $error,
        public ?string $finished_at,
        public string $id,
        public bool $is_production_promotion,
        public array $items,
        public string $manifest_revision,
        public int $manifest_version,
        public string $operation_label,
        public bool $production_confirmed,
        public string $project_id,
        public ?string $queued_at,
        public UserRef $requester,
        public EnvironmentTransferSecretPolicy $secret_policy,
        public EnvironmentTransferEnvironmentData $source_environment,
        public ?string $started_at,
        public EnvironmentTransferStatus $status,
        public string $status_color,
        public string $status_label,
        public EnvironmentTransferEnvironmentData $target_environment,
        public int $total_items,
        public string $updated_at,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            can_apply: (bool) $data['can_apply'],
            can_cancel: (bool) $data['can_cancel'],
            can_update: (bool) $data['can_update'],
            completed_items: (int) $data['completed_items'],
            created_at: (string) $data['created_at'],
            error: $data['error'] === null ? null : (string) $data['error'],
            finished_at: $data['finished_at'] === null ? null : (string) $data['finished_at'],
            id: (string) $data['id'],
            is_production_promotion: (bool) $data['is_production_promotion'],
            items: array_map(static fn (mixed $value): EnvironmentTransferItemData => EnvironmentTransferItemData::fromArray(self::objectValue($value)), self::listValue($data['items'])),
            manifest_revision: (string) $data['manifest_revision'],
            manifest_version: (int) $data['manifest_version'],
            operation_label: (string) $data['operation_label'],
            production_confirmed: (bool) $data['production_confirmed'],
            project_id: (string) $data['project_id'],
            queued_at: $data['queued_at'] === null ? null : (string) $data['queued_at'],
            requester: UserRef::fromArray(self::objectValue($data['requester'])),
            secret_policy: EnvironmentTransferSecretPolicy::from((string) $data['secret_policy']),
            source_environment: EnvironmentTransferEnvironmentData::fromArray(self::objectValue($data['source_environment'])),
            started_at: $data['started_at'] === null ? null : (string) $data['started_at'],
            status: EnvironmentTransferStatus::from((string) $data['status']),
            status_color: (string) $data['status_color'],
            status_label: (string) $data['status_label'],
            target_environment: EnvironmentTransferEnvironmentData::fromArray(self::objectValue($data['target_environment'])),
            total_items: (int) $data['total_items'],
            updated_at: (string) $data['updated_at'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['can_apply'] = $this->can_apply;
        $data['can_cancel'] = $this->can_cancel;
        $data['can_update'] = $this->can_update;
        $data['completed_items'] = $this->completed_items;
        $data['created_at'] = $this->created_at;
        $data['error'] = $this->error === null ? null : $this->error;
        $data['finished_at'] = $this->finished_at === null ? null : $this->finished_at;
        $data['id'] = $this->id;
        $data['is_production_promotion'] = $this->is_production_promotion;
        $data['items'] = array_map(static fn (EnvironmentTransferItemData $value) => $value->toArray(), $this->items);
        $data['manifest_revision'] = $this->manifest_revision;
        $data['manifest_version'] = $this->manifest_version;
        $data['operation_label'] = $this->operation_label;
        $data['production_confirmed'] = $this->production_confirmed;
        $data['project_id'] = $this->project_id;
        $data['queued_at'] = $this->queued_at === null ? null : $this->queued_at;
        $data['requester'] = $this->requester->toArray();
        $data['secret_policy'] = $this->secret_policy->value;
        $data['source_environment'] = $this->source_environment->toArray();
        $data['started_at'] = $this->started_at === null ? null : $this->started_at;
        $data['status'] = $this->status->value;
        $data['status_color'] = $this->status_color;
        $data['status_label'] = $this->status_label;
        $data['target_environment'] = $this->target_environment->toArray();
        $data['total_items'] = $this->total_items;
        $data['updated_at'] = $this->updated_at;

        return $data;
    }

    /**
     * @return array<string, mixed>
     */
    private static function objectValue(mixed $value): array
    {
        if (! is_array($value)) {
            throw new \InvalidArgumentException('Expected an object value.');
        }

        /** @var array<string, mixed> $value */
        return $value;
    }

    /**
     * @return list<mixed>
     */
    private static function listValue(mixed $value): array
    {
        if (! is_array($value)) {
            throw new \InvalidArgumentException('Expected an array value.');
        }

        return array_values($value);
    }
}
