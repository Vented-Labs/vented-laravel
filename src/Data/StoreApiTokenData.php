<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class StoreApiTokenData
{
    public function __construct(
        public string $name,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            name: (string) $data['name'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['name'] = $this->name;

        return $data;
    }
}
