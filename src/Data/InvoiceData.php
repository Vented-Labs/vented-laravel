<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class InvoiceData
{
    public function __construct(
        public string $currency,
        public string $date,
        public string $download_url,
        public string $id,
        public ?string $number,
        public string $status,
        public int $total,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            currency: (string) $data['currency'],
            date: (string) $data['date'],
            download_url: (string) $data['download_url'],
            id: (string) $data['id'],
            number: $data['number'] === null ? null : (string) $data['number'],
            status: (string) $data['status'],
            total: (int) $data['total'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['currency'] = $this->currency;
        $data['date'] = $this->date;
        $data['download_url'] = $this->download_url;
        $data['id'] = $this->id;
        $data['number'] = $this->number === null ? null : $this->number;
        $data['status'] = $this->status;
        $data['total'] = $this->total;

        return $data;
    }
}
