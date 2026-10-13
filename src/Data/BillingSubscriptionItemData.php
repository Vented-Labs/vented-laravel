<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class BillingSubscriptionItemData
{
    public function __construct(
        public string $key,
        public string $kind,
        public string $name,
        public int $quantity,
        public int $unit_amount,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            key: (string) $data['key'],
            kind: (string) $data['kind'],
            name: (string) $data['name'],
            quantity: (int) $data['quantity'],
            unit_amount: (int) $data['unit_amount'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['key'] = $this->key;
        $data['kind'] = $this->kind;
        $data['name'] = $this->name;
        $data['quantity'] = $this->quantity;
        $data['unit_amount'] = $this->unit_amount;

        return $data;
    }
}
