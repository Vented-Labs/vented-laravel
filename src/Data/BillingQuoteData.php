<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class BillingQuoteData
{
    /**
     * @param  list<string>|null  $coupon
     * @param  list<BillingSubscriptionItemData>  $items
     */
    public function __construct(
        public ?array $coupon,
        public string $expires_at,
        public string $id,
        public array $items,
        public string $kind,
        public BillingPreviewData $preview,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            coupon: $data['coupon'] === null ? null : array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['coupon'])),
            expires_at: (string) $data['expires_at'],
            id: (string) $data['id'],
            items: array_map(static fn (mixed $value): BillingSubscriptionItemData => BillingSubscriptionItemData::fromArray(self::objectValue($value)), self::listValue($data['items'])),
            kind: (string) $data['kind'],
            preview: BillingPreviewData::fromArray(self::objectValue($data['preview'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['coupon'] = $this->coupon === null ? null : $this->coupon;
        $data['expires_at'] = $this->expires_at;
        $data['id'] = $this->id;
        $data['items'] = array_map(static fn (BillingSubscriptionItemData $value) => $value->toArray(), $this->items);
        $data['kind'] = $this->kind;
        $data['preview'] = $this->preview->toArray();

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
