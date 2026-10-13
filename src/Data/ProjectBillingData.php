<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ProjectBillingData
{
    /**
     * @param  list<ProjectInvoiceData>  $invoices
     * @param  list<BillingSubscriptionItemData>  $items
     * @param  list<BillingProductData>  $products
     * @param  list<PromotionBenefitData>  $promotions
     */
    public function __construct(
        public ?AccountCreditData $account_credit,
        public BillingBandwidthData $bandwidth,
        public bool $cancel_at_period_end,
        public string $cancellations_url,
        public string $changes_url,
        public bool $collection_paused,
        public ?BillingContextData $context,
        public string $id,
        public bool $infrastructure_restricted,
        public array $invoices,
        public array $items,
        public int $list_amount,
        public ?int $net_amount,
        public string $owner_name,
        public ?PaymentCardData $payment_method,
        public string $payment_methods_url,
        public ?string $pending_operation_url,
        public ?string $period_end,
        public ?string $plan_key,
        public array $products,
        public string $project_id,
        public string $project_name,
        public array $promotions,
        public ?string $purge_at,
        public string $quotes_url,
        public ?string $reconciled_at,
        public bool $recovery_needed,
        public string $setup_intent_url,
        public StatusData $standing,
        public ?string $stripe_key,
        public StatusData $subscription_status,
        public ?string $suspend_at,
        public ?string $terminate_at,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            account_credit: $data['account_credit'] === null ? null : AccountCreditData::fromArray(self::objectValue($data['account_credit'])),
            bandwidth: BillingBandwidthData::fromArray(self::objectValue($data['bandwidth'])),
            cancel_at_period_end: (bool) $data['cancel_at_period_end'],
            cancellations_url: (string) $data['cancellations_url'],
            changes_url: (string) $data['changes_url'],
            collection_paused: (bool) $data['collection_paused'],
            context: $data['context'] === null ? null : BillingContextData::fromArray(self::objectValue($data['context'])),
            id: (string) $data['id'],
            infrastructure_restricted: (bool) $data['infrastructure_restricted'],
            invoices: array_map(static fn (mixed $value): ProjectInvoiceData => ProjectInvoiceData::fromArray(self::objectValue($value)), self::listValue($data['invoices'])),
            items: array_map(static fn (mixed $value): BillingSubscriptionItemData => BillingSubscriptionItemData::fromArray(self::objectValue($value)), self::listValue($data['items'])),
            list_amount: (int) $data['list_amount'],
            net_amount: $data['net_amount'] === null ? null : (int) $data['net_amount'],
            owner_name: (string) $data['owner_name'],
            payment_method: $data['payment_method'] === null ? null : PaymentCardData::fromArray(self::objectValue($data['payment_method'])),
            payment_methods_url: (string) $data['payment_methods_url'],
            pending_operation_url: $data['pending_operation_url'] === null ? null : (string) $data['pending_operation_url'],
            period_end: $data['period_end'] === null ? null : (string) $data['period_end'],
            plan_key: $data['plan_key'] === null ? null : (string) $data['plan_key'],
            products: array_map(static fn (mixed $value): BillingProductData => BillingProductData::fromArray(self::objectValue($value)), self::listValue($data['products'])),
            project_id: (string) $data['project_id'],
            project_name: (string) $data['project_name'],
            promotions: array_map(static fn (mixed $value): PromotionBenefitData => PromotionBenefitData::fromArray(self::objectValue($value)), self::listValue($data['promotions'])),
            purge_at: $data['purge_at'] === null ? null : (string) $data['purge_at'],
            quotes_url: (string) $data['quotes_url'],
            reconciled_at: $data['reconciled_at'] === null ? null : (string) $data['reconciled_at'],
            recovery_needed: (bool) $data['recovery_needed'],
            setup_intent_url: (string) $data['setup_intent_url'],
            standing: StatusData::fromArray(self::objectValue($data['standing'])),
            stripe_key: $data['stripe_key'] === null ? null : (string) $data['stripe_key'],
            subscription_status: StatusData::fromArray(self::objectValue($data['subscription_status'])),
            suspend_at: $data['suspend_at'] === null ? null : (string) $data['suspend_at'],
            terminate_at: $data['terminate_at'] === null ? null : (string) $data['terminate_at'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['account_credit'] = $this->account_credit === null ? null : $this->account_credit->toArray();
        $data['bandwidth'] = $this->bandwidth->toArray();
        $data['cancel_at_period_end'] = $this->cancel_at_period_end;
        $data['cancellations_url'] = $this->cancellations_url;
        $data['changes_url'] = $this->changes_url;
        $data['collection_paused'] = $this->collection_paused;
        $data['context'] = $this->context === null ? null : $this->context->toArray();
        $data['id'] = $this->id;
        $data['infrastructure_restricted'] = $this->infrastructure_restricted;
        $data['invoices'] = array_map(static fn (ProjectInvoiceData $value) => $value->toArray(), $this->invoices);
        $data['items'] = array_map(static fn (BillingSubscriptionItemData $value) => $value->toArray(), $this->items);
        $data['list_amount'] = $this->list_amount;
        $data['net_amount'] = $this->net_amount === null ? null : $this->net_amount;
        $data['owner_name'] = $this->owner_name;
        $data['payment_method'] = $this->payment_method === null ? null : $this->payment_method->toArray();
        $data['payment_methods_url'] = $this->payment_methods_url;
        $data['pending_operation_url'] = $this->pending_operation_url === null ? null : $this->pending_operation_url;
        $data['period_end'] = $this->period_end === null ? null : $this->period_end;
        $data['plan_key'] = $this->plan_key === null ? null : $this->plan_key;
        $data['products'] = array_map(static fn (BillingProductData $value) => $value->toArray(), $this->products);
        $data['project_id'] = $this->project_id;
        $data['project_name'] = $this->project_name;
        $data['promotions'] = array_map(static fn (PromotionBenefitData $value) => $value->toArray(), $this->promotions);
        $data['purge_at'] = $this->purge_at === null ? null : $this->purge_at;
        $data['quotes_url'] = $this->quotes_url;
        $data['reconciled_at'] = $this->reconciled_at === null ? null : $this->reconciled_at;
        $data['recovery_needed'] = $this->recovery_needed;
        $data['setup_intent_url'] = $this->setup_intent_url;
        $data['standing'] = $this->standing->toArray();
        $data['stripe_key'] = $this->stripe_key === null ? null : $this->stripe_key;
        $data['subscription_status'] = $this->subscription_status->toArray();
        $data['suspend_at'] = $this->suspend_at === null ? null : $this->suspend_at;
        $data['terminate_at'] = $this->terminate_at === null ? null : $this->terminate_at;

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
