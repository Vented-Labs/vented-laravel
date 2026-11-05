<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class SoftwareResourceMetricsData
{
    public function __construct(
        public InventoryMetricData $cpu,
        public InventoryMetricData $disk,
        public InventoryMetricData $memory,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            cpu: InventoryMetricData::fromArray(self::objectValue($data['cpu'])),
            disk: InventoryMetricData::fromArray(self::objectValue($data['disk'])),
            memory: InventoryMetricData::fromArray(self::objectValue($data['memory'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['cpu'] = $this->cpu->toArray();
        $data['disk'] = $this->disk->toArray();
        $data['memory'] = $this->memory->toArray();

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
