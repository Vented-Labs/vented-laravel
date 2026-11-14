<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ResourceUsageData
{
    /**
     * @param  list<ServiceMeterUsageData>  $services
     */
    public function __construct(
        public ResourceUsageMetricData $cpu,
        public ResourceUsageMetricData $disk,
        public ResourceUsageMetricData $memory,
        public string $sampled_at,
        public array $services,
        public string $source,
        public ResourceUsageMetricData $transfer,
        public ResourceUsageMetricData $tunnels,
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
            services: array_map(static fn (mixed $value): ServiceMeterUsageData => ServiceMeterUsageData::fromArray(self::objectValue($value)), self::listValue($data['services'])),
            source: (string) $data['source'],
            transfer: ResourceUsageMetricData::fromArray(self::objectValue($data['transfer'])),
            tunnels: ResourceUsageMetricData::fromArray(self::objectValue($data['tunnels'])),
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
        $data['services'] = array_map(static fn (ServiceMeterUsageData $value) => $value->toArray(), $this->services);
        $data['source'] = $this->source;
        $data['transfer'] = $this->transfer->toArray();
        $data['tunnels'] = $this->tunnels->toArray();

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

    /**
     * @return list<mixed>
     */
    private static function listValue(mixed $value): array
    {
        if (! is_array($value)) {
            throw new \InvalidArgumentException('Expected an array value.');
        }

        return array_values($value);
    }
}
