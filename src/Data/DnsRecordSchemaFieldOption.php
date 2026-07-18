<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class DnsRecordSchemaFieldOption
{
    public function __construct(
        public string $label,
        public string $value,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            label: (string) $data['label'],
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
        $data['value'] = $this->value;

        return $data;
    }
}
