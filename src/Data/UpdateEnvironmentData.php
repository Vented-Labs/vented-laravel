<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\OptionalValue;

final readonly class UpdateEnvironmentData
{
    public function __construct(
        public string|OptionalValue $name = OptionalValue::Missing,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            name: array_key_exists('name', $data) ? (string) $data['name'] : OptionalValue::Missing,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->name !== OptionalValue::Missing) {
            $data['name'] = $this->name;
        }

        return $data;
    }
}
