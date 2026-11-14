<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ProjectBillingSummaryData
{
    public function __construct(
        public ?string $billing_url,
        public ?BillingContextData $context,
        public string $owner_name,
        public ?string $plan_key,
        public ?string $plan_name,
        public string $project_id,
        public string $project_name,
        public ?StatusData $standing,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            billing_url: $data['billing_url'] === null ? null : (string) $data['billing_url'],
            context: $data['context'] === null ? null : BillingContextData::fromArray(self::objectValue($data['context'])),
            owner_name: (string) $data['owner_name'],
            plan_key: $data['plan_key'] === null ? null : (string) $data['plan_key'],
            plan_name: $data['plan_name'] === null ? null : (string) $data['plan_name'],
            project_id: (string) $data['project_id'],
            project_name: (string) $data['project_name'],
            standing: $data['standing'] === null ? null : StatusData::fromArray(self::objectValue($data['standing'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['billing_url'] = $this->billing_url === null ? null : $this->billing_url;
        $data['context'] = $this->context === null ? null : $this->context->toArray();
        $data['owner_name'] = $this->owner_name;
        $data['plan_key'] = $this->plan_key === null ? null : $this->plan_key;
        $data['plan_name'] = $this->plan_name === null ? null : $this->plan_name;
        $data['project_id'] = $this->project_id;
        $data['project_name'] = $this->project_name;
        $data['standing'] = $this->standing === null ? null : $this->standing->toArray();

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
