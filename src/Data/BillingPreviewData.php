<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class BillingPreviewData
{
    /**
     * @param  list<BillingLineData>  $lines
     */
    public function __construct(
        public int $amount_due,
        public int $credit_applied,
        public string $currency,
        public int $discount,
        public ?string $future_effective_at,
        public ?int $future_monthly_total,
        public array $lines,
        public int $subtotal,
        public ?int $tax,
        public int $total,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            amount_due: (int) $data['amount_due'],
            credit_applied: (int) $data['credit_applied'],
            currency: (string) $data['currency'],
            discount: (int) $data['discount'],
            future_effective_at: $data['future_effective_at'] === null ? null : (string) $data['future_effective_at'],
            future_monthly_total: $data['future_monthly_total'] === null ? null : (int) $data['future_monthly_total'],
            lines: array_map(static fn (mixed $value): BillingLineData => BillingLineData::fromArray(self::objectValue($value)), self::listValue($data['lines'])),
            subtotal: (int) $data['subtotal'],
            tax: $data['tax'] === null ? null : (int) $data['tax'],
            total: (int) $data['total'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['amount_due'] = $this->amount_due;
        $data['credit_applied'] = $this->credit_applied;
        $data['currency'] = $this->currency;
        $data['discount'] = $this->discount;
        $data['future_effective_at'] = $this->future_effective_at === null ? null : $this->future_effective_at;
        $data['future_monthly_total'] = $this->future_monthly_total === null ? null : $this->future_monthly_total;
        $data['lines'] = array_map(static fn (BillingLineData $value) => $value->toArray(), $this->lines);
        $data['subtotal'] = $this->subtotal;
        $data['tax'] = $this->tax === null ? null : $this->tax;
        $data['total'] = $this->total;

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
