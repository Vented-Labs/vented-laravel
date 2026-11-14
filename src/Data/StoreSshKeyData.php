<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class StoreSshKeyData
{
    public function __construct(
        public string $name,
        public string $public_key,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            name: (string) $data['name'],
            public_key: (string) $data['public_key'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['name'] = $this->name;
        $data['public_key'] = $this->public_key;

        return $data;
    }
}
