<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ApiTokenPermissionData
{
    /**
     * @param  list<string>  $implies
     */
    public function __construct(
        public string $access,
        public array $implies,
        public string $name,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            access: (string) $data['access'],
            implies: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['implies'])),
            name: (string) $data['name'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['access'] = $this->access;
        $data['implies'] = $this->implies;
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
