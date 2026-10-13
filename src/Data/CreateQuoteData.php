<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class CreateQuoteData
{
    /**
     * @param  array<string, mixed>  $items
     */
    public function __construct(
        public ?string $coupon,
        public array $items,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            coupon: $data['coupon'] === null ? null : (string) $data['coupon'],
            items: self::objectValue($data['items']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['coupon'] = $this->coupon === null ? null : $this->coupon;
        $data['items'] = $this->items;

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
