<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\StatusTone;

final readonly class StatusData
{
    public function __construct(
        public string $label,
        public StatusTone $tone,
        public bool $transitional,
        public string $value,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            label: (string) $data['label'],
            tone: StatusTone::from((string) $data['tone']),
            transitional: (bool) $data['transitional'],
            value: (string) $data['value'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['label'] = $this->label;
        $data['tone'] = $this->tone->value;
        $data['transitional'] = $this->transitional;
        $data['value'] = $this->value;

        return $data;
    }
}
