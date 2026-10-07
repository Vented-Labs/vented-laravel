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
        public int $bindings_count,
        public ?DnsZoneBoundTo $bound_to,
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
            bindings_count: (int) $data['bindings_count'],
            bound_to: $data['bound_to'] === null ? null : DnsZoneBoundTo::fromArray(self::objectValue($data['bound_to'])),
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
        $data['bindings_count'] = $this->bindings_count;
        $data['bound_to'] = $this->bound_to === null ? null : $this->bound_to->toArray();
        $data['domain'] = $this->domain;
        $data['id'] = $this->id;
        $data['records_count'] = $this->records_count;
        $data['services'] = array_map(static fn (DomainService $value) => $value->value, $this->services);

        return $data;
    }

    /**
     * @return array<string, mixed>
     */
    private static function objectValue(mixed $value): array
    {
        if (! is_array($value)) {
            throw new \InvalidArgumentException('Expected an object value.');
        }

        /** @var array<string, mixed> $value */
        return $value;
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
