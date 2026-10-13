<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class AccountCreditData
{
    public function __construct(
        public ?int $available,
        public string $currency,
        public ?string $synced_at,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            available: $data['available'] === null ? null : (int) $data['available'],
            currency: (string) $data['currency'],
            synced_at: $data['synced_at'] === null ? null : (string) $data['synced_at'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['available'] = $this->available === null ? null : $this->available;
        $data['currency'] = $this->currency;
        $data['synced_at'] = $this->synced_at === null ? null : $this->synced_at;

        return $data;
    }
}
