<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\OptionalValue;

final readonly class UpdateZoneData
{
    /**
     * @param  list<string>|OptionalValue  $services
     */
    public function __construct(
        public array|OptionalValue $services = OptionalValue::Missing,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            services: array_key_exists('services', $data) ? array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['services'])) : OptionalValue::Missing,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->services !== OptionalValue::Missing) {
            $data['services'] = $this->services;
        }

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
