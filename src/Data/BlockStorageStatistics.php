<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class BlockStorageStatistics
{
    public function __construct(
        public ?string $filesystem,
        public ?int $iops,
        public ?string $throughput,
        public ?int $total_bytes,
        public ?string $total_space,
        public ?float $usage_percent,
        public ?int $used_bytes,
        public ?string $used_space,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            filesystem: $data['filesystem'] === null ? null : (string) $data['filesystem'],
            iops: $data['iops'] === null ? null : (int) $data['iops'],
            throughput: $data['throughput'] === null ? null : (string) $data['throughput'],
            total_bytes: $data['total_bytes'] === null ? null : (int) $data['total_bytes'],
            total_space: $data['total_space'] === null ? null : (string) $data['total_space'],
            usage_percent: $data['usage_percent'] === null ? null : (float) $data['usage_percent'],
            used_bytes: $data['used_bytes'] === null ? null : (int) $data['used_bytes'],
            used_space: $data['used_space'] === null ? null : (string) $data['used_space'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['filesystem'] = $this->filesystem === null ? null : $this->filesystem;
        $data['iops'] = $this->iops === null ? null : $this->iops;
        $data['throughput'] = $this->throughput === null ? null : $this->throughput;
        $data['total_bytes'] = $this->total_bytes === null ? null : $this->total_bytes;
        $data['total_space'] = $this->total_space === null ? null : $this->total_space;
        $data['usage_percent'] = $this->usage_percent === null ? null : $this->usage_percent;
        $data['used_bytes'] = $this->used_bytes === null ? null : $this->used_bytes;
        $data['used_space'] = $this->used_space === null ? null : $this->used_space;

        return $data;
    }
}
