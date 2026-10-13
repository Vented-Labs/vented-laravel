<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class BillingLineData
{
    public function __construct(
        public int $amount,
        public ?string $description,
        public int $discount,
        public bool $proration,
        public ?int $quantity,
        public ?int $tax,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            amount: (int) $data['amount'],
            description: $data['description'] === null ? null : (string) $data['description'],
            discount: (int) $data['discount'],
            proration: (bool) $data['proration'],
            quantity: $data['quantity'] === null ? null : (int) $data['quantity'],
            tax: $data['tax'] === null ? null : (int) $data['tax'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['amount'] = $this->amount;
        $data['description'] = $this->description === null ? null : $this->description;
        $data['discount'] = $this->discount;
        $data['proration'] = $this->proration;
        $data['quantity'] = $this->quantity === null ? null : $this->quantity;
        $data['tax'] = $this->tax === null ? null : $this->tax;

        return $data;
    }
}
