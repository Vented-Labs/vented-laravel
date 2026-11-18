<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\OptionalValue;

final readonly class UpdateCertificateData
{
    public function __construct(
        public string|OptionalValue $chain = OptionalValue::Missing,
        public string|OptionalValue $name = OptionalValue::Missing,
        public string|OptionalValue $private_key = OptionalValue::Missing,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            chain: array_key_exists('chain', $data) ? (string) $data['chain'] : OptionalValue::Missing,
            name: array_key_exists('name', $data) ? (string) $data['name'] : OptionalValue::Missing,
            private_key: array_key_exists('private_key', $data) ? (string) $data['private_key'] : OptionalValue::Missing,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->chain !== OptionalValue::Missing) {
            $data['chain'] = $this->chain;
        }
        if ($this->name !== OptionalValue::Missing) {
            $data['name'] = $this->name;
        }
        if ($this->private_key !== OptionalValue::Missing) {
            $data['private_key'] = $this->private_key;
        }

        return $data;
    }
}
