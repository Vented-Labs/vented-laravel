<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class AppBlockStorageAttachmentData
{
    public function __construct(
        public StorageRef $block_storage,
        public string $block_storage_id,
        public string $id,
        public string $mount_point,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            block_storage: StorageRef::fromArray(self::objectValue($data['block_storage'])),
            block_storage_id: (string) $data['block_storage_id'],
            id: (string) $data['id'],
            mount_point: (string) $data['mount_point'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['block_storage'] = $this->block_storage->toArray();
        $data['block_storage_id'] = $this->block_storage_id;
        $data['id'] = $this->id;
        $data['mount_point'] = $this->mount_point;

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
