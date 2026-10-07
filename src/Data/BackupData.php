<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\BackupType;

final readonly class BackupData
{
    public function __construct(
        public string $created_at,
        public ?string $expire_at,
        public string $id,
        public ?int $size,
        public ?string $size_for_humans,
        public StatusData $status,
        public ?string $storage_id,
        public ?string $storage_name,
        public string $storage_type,
        public BackupType $type,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            created_at: (string) $data['created_at'],
            expire_at: $data['expire_at'] === null ? null : (string) $data['expire_at'],
            id: (string) $data['id'],
            size: $data['size'] === null ? null : (int) $data['size'],
            size_for_humans: $data['size_for_humans'] === null ? null : (string) $data['size_for_humans'],
            status: StatusData::fromArray(self::objectValue($data['status'])),
            storage_id: $data['storage_id'] === null ? null : (string) $data['storage_id'],
            storage_name: $data['storage_name'] === null ? null : (string) $data['storage_name'],
            storage_type: (string) $data['storage_type'],
            type: BackupType::from((string) $data['type']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['created_at'] = $this->created_at;
        $data['expire_at'] = $this->expire_at === null ? null : $this->expire_at;
        $data['id'] = $this->id;
        $data['size'] = $this->size === null ? null : $this->size;
        $data['size_for_humans'] = $this->size_for_humans === null ? null : $this->size_for_humans;
        $data['status'] = $this->status->toArray();
        $data['storage_id'] = $this->storage_id === null ? null : $this->storage_id;
        $data['storage_name'] = $this->storage_name === null ? null : $this->storage_name;
        $data['storage_type'] = $this->storage_type;
        $data['type'] = $this->type->value;

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
}
