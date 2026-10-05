<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class PlanSampleMetricData
{
    public function __construct(
        public float $limit,
        public string $unit,
        public float $used,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            limit: (float) $data['limit'],
            unit: (string) $data['unit'],
            used: (float) $data['used'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['limit'] = $this->limit;
        $data['unit'] = $this->unit;
        $data['used'] = $this->used;

        return $data;
    }
}
