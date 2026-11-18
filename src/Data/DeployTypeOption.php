<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\DeployType;

final readonly class DeployTypeOption
{
    public function __construct(
        public bool $available,
        public string $description,
        public string $icon,
        public string $label,
        public DeployType $value,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            available: (bool) $data['available'],
            description: (string) $data['description'],
            icon: (string) $data['icon'],
            label: (string) $data['label'],
            value: DeployType::from((string) $data['value']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['available'] = $this->available;
        $data['description'] = $this->description;
        $data['icon'] = $this->icon;
        $data['label'] = $this->label;
        $data['value'] = $this->value->value;

        return $data;
    }
}
