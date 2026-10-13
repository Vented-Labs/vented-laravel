<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class BillingProductData
{
    /**
     * @param  array<string, mixed>  $allowances
     */
    public function __construct(
        public array $allowances,
        public ?string $interval,
        public string $key,
        public string $kind,
        public string $name,
        public int $unit_amount,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            allowances: self::objectValue($data['allowances']),
            interval: $data['interval'] === null ? null : (string) $data['interval'],
            key: (string) $data['key'],
            kind: (string) $data['kind'],
            name: (string) $data['name'],
            unit_amount: (int) $data['unit_amount'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['allowances'] = $this->allowances;
        $data['interval'] = $this->interval === null ? null : $this->interval;
        $data['key'] = $this->key;
        $data['kind'] = $this->kind;
        $data['name'] = $this->name;
        $data['unit_amount'] = $this->unit_amount;

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
}
