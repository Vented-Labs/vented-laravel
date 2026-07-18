<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class StoreBlockStorageData
{
    public function __construct(
        public string $name,
        public int $size_gb,
        public string $storage_class_id,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            name: (string) $data['name'],
            size_gb: (int) $data['size_gb'],
            storage_class_id: (string) $data['storage_class_id'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['name'] = $this->name;
        $data['size_gb'] = $this->size_gb;
        $data['storage_class_id'] = $this->storage_class_id;

        return $data;
    }
}
