<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class PlanCatalogExtraData
{
    public function __construct(
        public ?string $detail,
        public string $label,
        public string $price,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            detail: $data['detail'] === null ? null : (string) $data['detail'],
            label: (string) $data['label'],
            price: (string) $data['price'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['detail'] = $this->detail === null ? null : $this->detail;
        $data['label'] = $this->label;
        $data['price'] = $this->price;

        return $data;
    }
}
