<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class BillingSecretData
{
    public function __construct(
        public ?string $client_secret,
        public ?string $hosted_invoice_url,
        public string $id,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            client_secret: $data['client_secret'] === null ? null : (string) $data['client_secret'],
            hosted_invoice_url: $data['hosted_invoice_url'] === null ? null : (string) $data['hosted_invoice_url'],
            id: (string) $data['id'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['client_secret'] = $this->client_secret === null ? null : $this->client_secret;
        $data['hosted_invoice_url'] = $this->hosted_invoice_url === null ? null : $this->hosted_invoice_url;
        $data['id'] = $this->id;

        return $data;
    }
}
