<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class StoreZoneData
{
    /**
     * @param  list<string>  $services
     */
    public function __construct(
        public string $domain,
        public array $services,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            domain: (string) $data['domain'],
            services: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['services'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['domain'] = $this->domain;
        $data['services'] = $this->services;

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
