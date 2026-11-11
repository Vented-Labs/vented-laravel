<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class PlanCatalogExtraData
{
    public function __construct(
        public ?string $billing_kind,
        public ?string $detail,
        public ?string $key,
        public string $label,
        public string $price,
        public ?string $resource,
        public ?int $units,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            billing_kind: $data['billing_kind'] === null ? null : (string) $data['billing_kind'],
            detail: $data['detail'] === null ? null : (string) $data['detail'],
            key: $data['key'] === null ? null : (string) $data['key'],
            label: (string) $data['label'],
            price: (string) $data['price'],
            resource: $data['resource'] === null ? null : (string) $data['resource'],
            units: $data['units'] === null ? null : (int) $data['units'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['billing_kind'] = $this->billing_kind === null ? null : $this->billing_kind;
        $data['detail'] = $this->detail === null ? null : $this->detail;
        $data['key'] = $this->key === null ? null : $this->key;
        $data['label'] = $this->label;
        $data['price'] = $this->price;
        $data['resource'] = $this->resource === null ? null : $this->resource;
        $data['units'] = $this->units === null ? null : $this->units;

        return $data;
    }
}
