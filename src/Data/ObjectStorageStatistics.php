<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ObjectStorageStatistics
{
    public function __construct(
        public int $bandwidth_bytes,
        public string $bandwidth_this_month,
        public int $objects_count,
        public int $requests_this_month,
        public string $storage_class,
        public string $total_size,
        public int $total_size_bytes,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            bandwidth_bytes: (int) $data['bandwidth_bytes'],
            bandwidth_this_month: (string) $data['bandwidth_this_month'],
            objects_count: (int) $data['objects_count'],
            requests_this_month: (int) $data['requests_this_month'],
            storage_class: (string) $data['storage_class'],
            total_size: (string) $data['total_size'],
            total_size_bytes: (int) $data['total_size_bytes'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['bandwidth_bytes'] = $this->bandwidth_bytes;
        $data['bandwidth_this_month'] = $this->bandwidth_this_month;
        $data['objects_count'] = $this->objects_count;
        $data['requests_this_month'] = $this->requests_this_month;
        $data['storage_class'] = $this->storage_class;
        $data['total_size'] = $this->total_size;
        $data['total_size_bytes'] = $this->total_size_bytes;

        return $data;
    }
}
