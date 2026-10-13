<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class PaymentCardData
{
    public function __construct(
        public string $brand,
        public ?int $exp_month,
        public ?int $exp_year,
        public string $last4,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            brand: (string) $data['brand'],
            exp_month: $data['exp_month'] === null ? null : (int) $data['exp_month'],
            exp_year: $data['exp_year'] === null ? null : (int) $data['exp_year'],
            last4: (string) $data['last4'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['brand'] = $this->brand;
        $data['exp_month'] = $this->exp_month === null ? null : $this->exp_month;
        $data['exp_year'] = $this->exp_year === null ? null : $this->exp_year;
        $data['last4'] = $this->last4;

        return $data;
    }
}
