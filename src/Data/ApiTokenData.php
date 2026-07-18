<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ApiTokenData
{
    /**
     * @param  list<string>  $abilities
     */
    public function __construct(
        public array $abilities,
        public string $created_at,
        public string $id,
        public ?string $last_used_at,
        public string $name,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            abilities: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['abilities'])),
            created_at: (string) $data['created_at'],
            id: (string) $data['id'],
            last_used_at: $data['last_used_at'] === null ? null : (string) $data['last_used_at'],
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
        $data['created_at'] = $this->created_at;
        $data['id'] = $this->id;
        $data['last_used_at'] = $this->last_used_at === null ? null : $this->last_used_at;
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
