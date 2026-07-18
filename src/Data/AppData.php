<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\AppStatus;
use Vented\Enums\InstallableType;

final readonly class AppData
{
    /**
     * @param  list<AppBlockStorageAttachmentData>  $block_storage_attachments
     * @param  list<string>  $domains
     */
    public function __construct(
        public array $block_storage_attachments,
        public string $created_at,
        public array $domains,
        public string $id,
        public ?InstallableRef $installable,
        public string $installable_identifier,
        public InstallableType $installable_type,
        public string $name,
        public string $status,
        public string $status_color,
        public ?string $status_error,
        public AppStatus $status_raw,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            block_storage_attachments: array_map(static fn (mixed $value): AppBlockStorageAttachmentData => AppBlockStorageAttachmentData::fromArray(self::objectValue($value)), self::listValue($data['block_storage_attachments'])),
            created_at: (string) $data['created_at'],
            domains: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['domains'])),
            id: (string) $data['id'],
            installable: $data['installable'] === null ? null : InstallableRef::fromArray(self::objectValue($data['installable'])),
            installable_identifier: (string) $data['installable_identifier'],
            installable_type: InstallableType::from((string) $data['installable_type']),
            name: (string) $data['name'],
            status: (string) $data['status'],
            status_color: (string) $data['status_color'],
            status_error: $data['status_error'] === null ? null : (string) $data['status_error'],
            status_raw: AppStatus::from((string) $data['status_raw']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['block_storage_attachments'] = array_map(static fn (AppBlockStorageAttachmentData $value) => $value->toArray(), $this->block_storage_attachments);
        $data['created_at'] = $this->created_at;
        $data['domains'] = $this->domains;
        $data['id'] = $this->id;
        $data['installable'] = $this->installable === null ? null : $this->installable->toArray();
        $data['installable_identifier'] = $this->installable_identifier;
        $data['installable_type'] = $this->installable_type->value;
        $data['name'] = $this->name;
        $data['status'] = $this->status;
        $data['status_color'] = $this->status_color;
        $data['status_error'] = $this->status_error === null ? null : $this->status_error;
        $data['status_raw'] = $this->status_raw->value;

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
