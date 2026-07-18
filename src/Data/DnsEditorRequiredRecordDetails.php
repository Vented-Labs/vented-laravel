<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class DnsEditorRequiredRecordDetails
{
    public function __construct(
        public int $ttl,
        public string $value,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            ttl: (int) $data['ttl'],
            value: (string) $data['value'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['ttl'] = $this->ttl;
        $data['value'] = $this->value;

        return $data;
    }
}
