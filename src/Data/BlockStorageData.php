<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\StorageStatus;

final readonly class BlockStorageData
{
    public function __construct(
        public ?string $created_at,
        public ?string $filesystem,
        public string $id,
        public string $name,
        public ?int $size_gb,
        public StorageStatus $status,
        public ?string $status_error,
        public StorageClassRef $storage_class,
        public ?float $usage,
        public ?int $used_space_mb,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            created_at: $data['created_at'] === null ? null : (string) $data['created_at'],
            filesystem: $data['filesystem'] === null ? null : (string) $data['filesystem'],
            id: (string) $data['id'],
            name: (string) $data['name'],
            size_gb: $data['size_gb'] === null ? null : (int) $data['size_gb'],
            status: StorageStatus::from((string) $data['status']),
            status_error: $data['status_error'] === null ? null : (string) $data['status_error'],
            storage_class: StorageClassRef::fromArray(self::objectValue($data['storage_class'])),
            usage: $data['usage'] === null ? null : (float) $data['usage'],
            used_space_mb: $data['used_space_mb'] === null ? null : (int) $data['used_space_mb'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['created_at'] = $this->created_at === null ? null : $this->created_at;
        $data['filesystem'] = $this->filesystem === null ? null : $this->filesystem;
        $data['id'] = $this->id;
        $data['name'] = $this->name;
        $data['size_gb'] = $this->size_gb === null ? null : $this->size_gb;
        $data['status'] = $this->status->value;
        $data['status_error'] = $this->status_error === null ? null : $this->status_error;
        $data['storage_class'] = $this->storage_class->toArray();
        $data['usage'] = $this->usage === null ? null : $this->usage;
        $data['used_space_mb'] = $this->used_space_mb === null ? null : $this->used_space_mb;

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
