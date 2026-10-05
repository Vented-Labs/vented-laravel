<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ObjectStorageStatistics
{
    public function __construct(
        public ?int $bandwidth_bytes,
        public ?string $bandwidth_this_month,
        public ?int $objects_count,
        public ?int $requests_this_month,
        public ?string $storage_class,
        public ?string $total_size,
        public ?int $total_size_bytes,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            bandwidth_bytes: $data['bandwidth_bytes'] === null ? null : (int) $data['bandwidth_bytes'],
            bandwidth_this_month: $data['bandwidth_this_month'] === null ? null : (string) $data['bandwidth_this_month'],
            objects_count: $data['objects_count'] === null ? null : (int) $data['objects_count'],
            requests_this_month: $data['requests_this_month'] === null ? null : (int) $data['requests_this_month'],
            storage_class: $data['storage_class'] === null ? null : (string) $data['storage_class'],
            total_size: $data['total_size'] === null ? null : (string) $data['total_size'],
            total_size_bytes: $data['total_size_bytes'] === null ? null : (int) $data['total_size_bytes'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['bandwidth_bytes'] = $this->bandwidth_bytes === null ? null : $this->bandwidth_bytes;
        $data['bandwidth_this_month'] = $this->bandwidth_this_month === null ? null : $this->bandwidth_this_month;
        $data['objects_count'] = $this->objects_count === null ? null : $this->objects_count;
        $data['requests_this_month'] = $this->requests_this_month === null ? null : $this->requests_this_month;
        $data['storage_class'] = $this->storage_class === null ? null : $this->storage_class;
        $data['total_size'] = $this->total_size === null ? null : $this->total_size;
        $data['total_size_bytes'] = $this->total_size_bytes === null ? null : $this->total_size_bytes;

        return $data;
    }
}
