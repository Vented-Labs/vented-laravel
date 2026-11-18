<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class DnsZoneRequiredRecord
{
    public function __construct(
        public bool $can_add,
        public string $name,
        public string $type,
        public string $value,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            can_add: (bool) $data['can_add'],
            name: (string) $data['name'],
            type: (string) $data['type'],
            value: (string) $data['value'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['can_add'] = $this->can_add;
        $data['name'] = $this->name;
        $data['type'] = $this->type;
        $data['value'] = $this->value;

        return $data;
    }
}
