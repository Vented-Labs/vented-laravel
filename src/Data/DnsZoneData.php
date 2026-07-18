<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\DomainService;

final readonly class DnsZoneData
{
    /**
     * @param  list<DomainService>  $services
     */
    public function __construct(
        public string $domain,
        public string $id,
        public int $records_count,
        public array $services,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            domain: (string) $data['domain'],
            id: (string) $data['id'],
            records_count: (int) $data['records_count'],
            services: array_map(static fn (mixed $value): DomainService => DomainService::from((string) $value), self::listValue($data['services'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['domain'] = $this->domain;
        $data['id'] = $this->id;
        $data['records_count'] = $this->records_count;
        $data['services'] = array_map(static fn (DomainService $value) => $value->value, $this->services);

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
