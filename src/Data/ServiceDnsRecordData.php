<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ServiceDnsRecordData
{
    public function __construct(
        public string $name,
        public bool $published,
        public string $type,
        public string $value,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            name: (string) $data['name'],
            published: (bool) $data['published'],
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
        $data['name'] = $this->name;
        $data['published'] = $this->published;
        $data['type'] = $this->type;
        $data['value'] = $this->value;

        return $data;
    }
}
