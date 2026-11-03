<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ResourceUsageData
{
    public function __construct(
        public ResourceUsageMetricData $cpu,
        public ResourceUsageMetricData $disk,
        public ResourceUsageMetricData $memory,
        public string $sampled_at,
        public string $source,
        public ResourceUsageMetricData $transfer,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            cpu: ResourceUsageMetricData::fromArray(self::objectValue($data['cpu'])),
            disk: ResourceUsageMetricData::fromArray(self::objectValue($data['disk'])),
            memory: ResourceUsageMetricData::fromArray(self::objectValue($data['memory'])),
            sampled_at: (string) $data['sampled_at'],
            source: (string) $data['source'],
            transfer: ResourceUsageMetricData::fromArray(self::objectValue($data['transfer'])),
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
        $data['sampled_at'] = $this->sampled_at;
        $data['source'] = $this->source;
        $data['transfer'] = $this->transfer->toArray();

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
