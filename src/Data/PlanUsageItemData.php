<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class PlanUsageItemData
{
    public function __construct(
        public ?string $help,
        public string $key,
        public string $label,
        public ?float $limit,
        public ?float $percent,
        public ?string $unit,
        public float $used,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            help: $data['help'] === null ? null : (string) $data['help'],
            key: (string) $data['key'],
            label: (string) $data['label'],
            limit: $data['limit'] === null ? null : (float) $data['limit'],
            percent: $data['percent'] === null ? null : (float) $data['percent'],
            unit: $data['unit'] === null ? null : (string) $data['unit'],
            used: (float) $data['used'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['help'] = $this->help === null ? null : $this->help;
        $data['key'] = $this->key;
        $data['label'] = $this->label;
        $data['limit'] = $this->limit === null ? null : $this->limit;
        $data['percent'] = $this->percent === null ? null : $this->percent;
        $data['unit'] = $this->unit === null ? null : $this->unit;
        $data['used'] = $this->used;

        return $data;
    }
}
