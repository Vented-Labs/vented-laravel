<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\DnsRecordType;

final readonly class DnsRecordData
{
    public function __construct(
        public string $id,
        public string $name,
        public ?int $priority,
        public bool $system_generated,
        public ?int $ttl,
        public DnsRecordType $type,
        public string $value,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: (string) $data['id'],
            name: (string) $data['name'],
            priority: $data['priority'] === null ? null : (int) $data['priority'],
            system_generated: (bool) $data['system_generated'],
            ttl: $data['ttl'] === null ? null : (int) $data['ttl'],
            type: DnsRecordType::from((string) $data['type']),
            value: (string) $data['value'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['id'] = $this->id;
        $data['name'] = $this->name;
        $data['priority'] = $this->priority === null ? null : $this->priority;
        $data['system_generated'] = $this->system_generated;
        $data['ttl'] = $this->ttl === null ? null : $this->ttl;
        $data['type'] = $this->type->value;
        $data['value'] = $this->value;

        return $data;
    }
}
