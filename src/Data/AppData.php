<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\AppDesiredStatus;
use Vented\Enums\InstallableType;

final readonly class AppData
{
    /**
     * @param  list<AppBlockStorageAttachmentData>  $block_storage_attachments
     * @param  list<string>  $domains
     */
    public function __construct(
        public AppActions $actions,
        public array $block_storage_attachments,
        public string $created_at,
        public ?AppDesiredStatus $desired_status,
        public array $domains,
        public int $generation,
        public string $id,
        public ?InstallableRef $installable,
        public string $installable_identifier,
        public InstallableType $installable_type,
        public string $name,
        public bool $pending_operation,
        public StatusData $status,
        public ?string $status_error,
        public ?ResourceTelemetry $telemetry,
        public string $updated_at,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            actions: AppActions::fromArray(self::objectValue($data['actions'])),
            block_storage_attachments: array_map(static fn (mixed $value): AppBlockStorageAttachmentData => AppBlockStorageAttachmentData::fromArray(self::objectValue($value)), self::listValue($data['block_storage_attachments'])),
            created_at: (string) $data['created_at'],
            desired_status: $data['desired_status'] === null ? null : AppDesiredStatus::from((string) $data['desired_status']),
            domains: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['domains'])),
            generation: (int) $data['generation'],
            id: (string) $data['id'],
            installable: $data['installable'] === null ? null : InstallableRef::fromArray(self::objectValue($data['installable'])),
            installable_identifier: (string) $data['installable_identifier'],
            installable_type: InstallableType::from((string) $data['installable_type']),
            name: (string) $data['name'],
            pending_operation: (bool) $data['pending_operation'],
            status: StatusData::fromArray(self::objectValue($data['status'])),
            status_error: $data['status_error'] === null ? null : (string) $data['status_error'],
            telemetry: $data['telemetry'] === null ? null : ResourceTelemetry::fromArray(self::objectValue($data['telemetry'])),
            updated_at: (string) $data['updated_at'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['actions'] = $this->actions->toArray();
        $data['block_storage_attachments'] = array_map(static fn (AppBlockStorageAttachmentData $value) => $value->toArray(), $this->block_storage_attachments);
        $data['created_at'] = $this->created_at;
        $data['desired_status'] = $this->desired_status === null ? null : $this->desired_status->value;
        $data['domains'] = $this->domains;
        $data['generation'] = $this->generation;
        $data['id'] = $this->id;
        $data['installable'] = $this->installable === null ? null : $this->installable->toArray();
        $data['installable_identifier'] = $this->installable_identifier;
        $data['installable_type'] = $this->installable_type->value;
        $data['name'] = $this->name;
        $data['pending_operation'] = $this->pending_operation;
        $data['status'] = $this->status->toArray();
        $data['status_error'] = $this->status_error === null ? null : $this->status_error;
        $data['telemetry'] = $this->telemetry === null ? null : $this->telemetry->toArray();
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
