<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\OptionalValue;

final readonly class FormOption
{
    public function __construct(
        public string $label,
        public string $value,
        public string|null|OptionalValue $description = OptionalValue::Missing,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            label: (string) $data['label'],
            value: (string) $data['value'],
            description: array_key_exists('description', $data) ? $data['description'] === null ? null : (string) $data['description'] : OptionalValue::Missing,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['label'] = $this->label;
        $data['value'] = $this->value;
        if ($this->description !== OptionalValue::Missing) {
            $data['description'] = $this->description === null ? null : $this->description;
        }

        return $data;
    }
}
