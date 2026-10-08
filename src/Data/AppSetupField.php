<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class AppSetupField
{
    public function __construct(
        public string $label,
        public string $name,
        public bool $sensitive,
        public ?string $value,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            label: (string) $data['label'],
            name: (string) $data['name'],
            sensitive: (bool) $data['sensitive'],
            value: $data['value'] === null ? null : (string) $data['value'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['label'] = $this->label;
        $data['name'] = $this->name;
        $data['sensitive'] = $this->sensitive;
        $data['value'] = $this->value === null ? null : $this->value;

        return $data;
    }
}
