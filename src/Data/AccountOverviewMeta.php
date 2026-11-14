<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class AccountOverviewMeta
{
    public function __construct(
        public AccountOverviewMetaBilling $billing,
        public AccountOverviewMetaDangerZone $danger_zone,
        public AccountOverviewMetaProfile $profile,
        public AccountOverviewMetaProjects $projects,
        public AccountOverviewMetaSecurity $security,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            billing: AccountOverviewMetaBilling::fromArray(self::objectValue($data['billing'])),
            danger_zone: AccountOverviewMetaDangerZone::fromArray(self::objectValue($data['danger_zone'])),
            profile: AccountOverviewMetaProfile::fromArray(self::objectValue($data['profile'])),
            projects: AccountOverviewMetaProjects::fromArray(self::objectValue($data['projects'])),
            security: AccountOverviewMetaSecurity::fromArray(self::objectValue($data['security'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['billing'] = $this->billing->toArray();
        $data['danger_zone'] = $this->danger_zone->toArray();
        $data['profile'] = $this->profile->toArray();
        $data['projects'] = $this->projects->toArray();
        $data['security'] = $this->security->toArray();

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
