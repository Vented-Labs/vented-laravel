<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ServiceLiveData
{
    /**
     * @param  list<ServiceDnsRecordData>  $dns_records
     */
    public function __construct(
        public array $dns_records,
        public bool $reachable,
        public ?string $waiting,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            dns_records: array_map(static fn (mixed $value): ServiceDnsRecordData => ServiceDnsRecordData::fromArray(self::objectValue($value)), self::listValue($data['dns_records'])),
            reachable: (bool) $data['reachable'],
            waiting: $data['waiting'] === null ? null : (string) $data['waiting'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['dns_records'] = array_map(static fn (ServiceDnsRecordData $value) => $value->toArray(), $this->dns_records);
        $data['reachable'] = $this->reachable;
        $data['waiting'] = $this->waiting === null ? null : $this->waiting;

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
