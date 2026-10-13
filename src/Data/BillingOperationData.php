<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class BillingOperationData
{
    public function __construct(
        public ?string $confirmation_url,
        public string $id,
        public bool $infrastructure_restricted,
        public ?string $invoice_id,
        public string $kind,
        public bool $reconciled,
        public bool $requote_required,
        public bool $settled,
        public StatusData $status,
        public string $status_url,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            confirmation_url: $data['confirmation_url'] === null ? null : (string) $data['confirmation_url'],
            id: (string) $data['id'],
            infrastructure_restricted: (bool) $data['infrastructure_restricted'],
            invoice_id: $data['invoice_id'] === null ? null : (string) $data['invoice_id'],
            kind: (string) $data['kind'],
            reconciled: (bool) $data['reconciled'],
            requote_required: (bool) $data['requote_required'],
            settled: (bool) $data['settled'],
            status: StatusData::fromArray(self::objectValue($data['status'])),
            status_url: (string) $data['status_url'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['confirmation_url'] = $this->confirmation_url === null ? null : $this->confirmation_url;
        $data['id'] = $this->id;
        $data['infrastructure_restricted'] = $this->infrastructure_restricted;
        $data['invoice_id'] = $this->invoice_id === null ? null : $this->invoice_id;
        $data['kind'] = $this->kind;
        $data['reconciled'] = $this->reconciled;
        $data['requote_required'] = $this->requote_required;
        $data['settled'] = $this->settled;
        $data['status'] = $this->status->toArray();
        $data['status_url'] = $this->status_url;

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
