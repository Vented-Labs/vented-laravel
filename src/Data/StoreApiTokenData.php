<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class StoreApiTokenData
{
    /**
     * @param  list<string>  $abilities
     */
    public function __construct(
        public array $abilities,
        public string $expires_at,
        public string $name,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            abilities: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['abilities'])),
            expires_at: (string) $data['expires_at'],
            name: (string) $data['name'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['abilities'] = $this->abilities;
        $data['expires_at'] = $this->expires_at;
        $data['name'] = $this->name;

        return $data;
    }

    /**
     * @return list<mixed>
     */
    private static function listValue(mixed $value): array
    {
        if (! is_array($value)) {
            throw new \InvalidArgumentException('Expected an array value.');
        }

        return array_values($value);
    }
}
