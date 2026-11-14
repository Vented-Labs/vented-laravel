<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class SupportOverviewMetaStat
{
    public function __construct(
        public string $color,
        public string $label,
        public int $value,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            color: (string) $data['color'],
            label: (string) $data['label'],
            value: (int) $data['value'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['color'] = $this->color;
        $data['label'] = $this->label;
        $data['value'] = $this->value;

        return $data;
    }
}
