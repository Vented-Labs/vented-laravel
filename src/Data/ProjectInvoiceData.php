<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ProjectInvoiceData
{
    /**
     * @param  list<BillingLineData>  $lines
     */
    public function __construct(
        public int $amount_paid,
        public int $amount_remaining,
        public string $confirmation_url,
        public ?int $credit_note_amount,
        public string $currency,
        public int $discount,
        public string $download_url,
        public ?string $due_at,
        public string $id,
        public ?string $issued_at,
        public array $lines,
        public ?string $number,
        public StatusData $status,
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
            amount_paid: (int) $data['amount_paid'],
            amount_remaining: (int) $data['amount_remaining'],
            confirmation_url: (string) $data['confirmation_url'],
            credit_note_amount: $data['credit_note_amount'] === null ? null : (int) $data['credit_note_amount'],
            currency: (string) $data['currency'],
            discount: (int) $data['discount'],
            download_url: (string) $data['download_url'],
            due_at: $data['due_at'] === null ? null : (string) $data['due_at'],
            id: (string) $data['id'],
            issued_at: $data['issued_at'] === null ? null : (string) $data['issued_at'],
            lines: array_map(static fn (mixed $value): BillingLineData => BillingLineData::fromArray(self::objectValue($value)), self::listValue($data['lines'])),
            number: $data['number'] === null ? null : (string) $data['number'],
            status: StatusData::fromArray(self::objectValue($data['status'])),
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
        $data['amount_paid'] = $this->amount_paid;
        $data['amount_remaining'] = $this->amount_remaining;
        $data['confirmation_url'] = $this->confirmation_url;
        $data['credit_note_amount'] = $this->credit_note_amount === null ? null : $this->credit_note_amount;
        $data['currency'] = $this->currency;
        $data['discount'] = $this->discount;
        $data['download_url'] = $this->download_url;
        $data['due_at'] = $this->due_at === null ? null : $this->due_at;
        $data['id'] = $this->id;
        $data['issued_at'] = $this->issued_at === null ? null : $this->issued_at;
        $data['lines'] = array_map(static fn (BillingLineData $value) => $value->toArray(), $this->lines);
        $data['number'] = $this->number === null ? null : $this->number;
        $data['status'] = $this->status->toArray();
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
