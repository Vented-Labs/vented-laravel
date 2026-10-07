<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\BindableType;

final readonly class DnsZoneBoundTo
{
    public function __construct(
        public string $hostname,
        public BindableType $kind,
        public string $name,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            hostname: (string) $data['hostname'],
            kind: BindableType::from((string) $data['kind']),
            name: (string) $data['name'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['hostname'] = $this->hostname;
        $data['kind'] = $this->kind->value;
        $data['name'] = $this->name;

        return $data;
    }
}
