<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class BillingOverviewData
{
    /**
     * @param  list<ProjectBillingSummaryData>  $projects
     */
    public function __construct(
        public bool $has_payment_method,
        public string $id,
        public array $projects,
        public string $stripe_currency,
        public int $subscription_count,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            has_payment_method: (bool) $data['has_payment_method'],
            id: (string) $data['id'],
            projects: array_map(static fn (mixed $value): ProjectBillingSummaryData => ProjectBillingSummaryData::fromArray(self::objectValue($value)), self::listValue($data['projects'])),
            stripe_currency: (string) $data['stripe_currency'],
            subscription_count: (int) $data['subscription_count'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['has_payment_method'] = $this->has_payment_method;
        $data['id'] = $this->id;
        $data['projects'] = array_map(static fn (ProjectBillingSummaryData $value) => $value->toArray(), $this->projects);
        $data['stripe_currency'] = $this->stripe_currency;
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
