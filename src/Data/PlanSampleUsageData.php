<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class PlanSampleUsageData
{
    public function __construct(
        public PlanSampleMetricData $cpu,
        public PlanSampleMetricData $disk,
        public string $illustration_plan_id,
        public PlanSampleMetricData $memory,
        public string $sampled_at,
        public string $source,
        public PlanSampleMetricData $transfer,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            cpu: PlanSampleMetricData::fromArray(self::objectValue($data['cpu'])),
            disk: PlanSampleMetricData::fromArray(self::objectValue($data['disk'])),
            illustration_plan_id: (string) $data['illustration_plan_id'],
            memory: PlanSampleMetricData::fromArray(self::objectValue($data['memory'])),
            sampled_at: (string) $data['sampled_at'],
            source: (string) $data['source'],
            transfer: PlanSampleMetricData::fromArray(self::objectValue($data['transfer'])),
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
        $data['illustration_plan_id'] = $this->illustration_plan_id;
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
