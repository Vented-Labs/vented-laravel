<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\DnsRecordType;

final readonly class UpdateRecordData
{
    public function __construct(
        public string $name,
        public ?int $priority,
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
            name: (string) $data['name'],
            priority: $data['priority'] === null ? null : (int) $data['priority'],
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
        $data['name'] = $this->name;
        $data['priority'] = $this->priority === null ? null : $this->priority;
        $data['ttl'] = $this->ttl === null ? null : $this->ttl;
        $data['type'] = $this->type->value;
        $data['value'] = $this->value;

        return $data;
    }
}
