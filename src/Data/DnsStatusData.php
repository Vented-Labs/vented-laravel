<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class DnsStatusData
{
    /**
     * @param  list<DnsStatusEntry>  $statuses
     */
    public function __construct(
        public array $statuses,
        public string $zone_id,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            statuses: array_map(static fn (mixed $value): DnsStatusEntry => DnsStatusEntry::fromArray(self::objectValue($value)), self::listValue($data['statuses'])),
            zone_id: (string) $data['zone_id'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['statuses'] = array_map(static fn (DnsStatusEntry $value) => $value->toArray(), $this->statuses);
        $data['zone_id'] = $this->zone_id;

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
