<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ProjectBillingHubData
{
    public function __construct(
        public ?ProjectBillingData $billing,
        public bool $can_manage_billing,
        public string $id,
        public string $owner_name,
        public PlanData $plan,
        public string $project_name,
        public PlanUsageDetailData $usage,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            billing: $data['billing'] === null ? null : ProjectBillingData::fromArray(self::objectValue($data['billing'])),
            can_manage_billing: (bool) $data['can_manage_billing'],
            id: (string) $data['id'],
            owner_name: (string) $data['owner_name'],
            plan: PlanData::fromArray(self::objectValue($data['plan'])),
            project_name: (string) $data['project_name'],
            usage: PlanUsageDetailData::fromArray(self::objectValue($data['usage'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['billing'] = $this->billing === null ? null : $this->billing->toArray();
        $data['can_manage_billing'] = $this->can_manage_billing;
        $data['id'] = $this->id;
        $data['owner_name'] = $this->owner_name;
        $data['plan'] = $this->plan->toArray();
        $data['project_name'] = $this->project_name;
        $data['usage'] = $this->usage->toArray();

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
