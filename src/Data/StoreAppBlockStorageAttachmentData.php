<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class StoreAppBlockStorageAttachmentData
{
    public function __construct(
        public string $block_storage_id,
        public string $mount_point,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            block_storage_id: (string) $data['block_storage_id'],
            mount_point: (string) $data['mount_point'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['block_storage_id'] = $this->block_storage_id;
        $data['mount_point'] = $this->mount_point;

        return $data;
    }
}
