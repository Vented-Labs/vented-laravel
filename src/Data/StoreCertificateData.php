<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class StoreCertificateData
{
    public function __construct(
        public string $chain,
        public ?string $name,
        public string $private_key,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            chain: (string) $data['chain'],
            name: $data['name'] === null ? null : (string) $data['name'],
            private_key: (string) $data['private_key'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['chain'] = $this->chain;
        $data['name'] = $this->name === null ? null : $this->name;
        $data['private_key'] = $this->private_key;

        return $data;
    }
}
