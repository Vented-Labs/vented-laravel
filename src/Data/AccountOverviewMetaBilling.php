<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class AccountOverviewMetaBilling
{
    /**
     * @param  list<BillingContextData>  $contexts
     */
    public function __construct(
        public array $contexts,
        public bool $has_payment_method,
        public int $subscription_count,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            contexts: array_map(static fn (mixed $value): BillingContextData => BillingContextData::fromArray(self::objectValue($value)), self::listValue($data['contexts'])),
            has_payment_method: (bool) $data['has_payment_method'],
            subscription_count: (int) $data['subscription_count'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['contexts'] = array_map(static fn (BillingContextData $value) => $value->toArray(), $this->contexts);
        $data['has_payment_method'] = $this->has_payment_method;
        $data['subscription_count'] = $this->subscription_count;

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
