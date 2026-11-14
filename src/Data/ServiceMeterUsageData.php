<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ServiceMeterUsageData
{
    public function __construct(
        public ?string $icon,
        public string $label,
        public ?float $limit,
        public string $meter,
        public ?string $period,
        public string $unit,
        public ?float $used,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            icon: $data['icon'] === null ? null : (string) $data['icon'],
            label: (string) $data['label'],
            limit: $data['limit'] === null ? null : (float) $data['limit'],
            meter: (string) $data['meter'],
            period: $data['period'] === null ? null : (string) $data['period'],
            unit: (string) $data['unit'],
            used: $data['used'] === null ? null : (float) $data['used'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['icon'] = $this->icon === null ? null : $this->icon;
        $data['label'] = $this->label;
        $data['limit'] = $this->limit === null ? null : $this->limit;
        $data['meter'] = $this->meter;
        $data['period'] = $this->period === null ? null : $this->period;
        $data['unit'] = $this->unit;
        $data['used'] = $this->used === null ? null : $this->used;

        return $data;
    }
}
