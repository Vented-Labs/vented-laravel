<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class SoftwareResourceContextData
{
    /**
     * @param  list<string>  $issue_ids
     * @param  list<SoftwareMembershipData>  $memberships
     */
    public function __construct(
        public ?string $attached_to,
        public bool $attention,
        public bool $can_open,
        public bool $can_update,
        public ?string $expected_state,
        public ?string $hosting_mode,
        public string $href,
        public ?string $icon,
        public array $issue_ids,
        public string $key,
        public string $kind,
        public array $memberships,
        public SoftwareResourceMetricsData $metrics,
        public string $resource_id,
        public string $software_label,
        public ?string $version,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            attached_to: $data['attached_to'] === null ? null : (string) $data['attached_to'],
            attention: (bool) $data['attention'],
            can_open: (bool) $data['can_open'],
            can_update: (bool) $data['can_update'],
            expected_state: $data['expected_state'] === null ? null : (string) $data['expected_state'],
            hosting_mode: $data['hosting_mode'] === null ? null : (string) $data['hosting_mode'],
            href: (string) $data['href'],
            icon: $data['icon'] === null ? null : (string) $data['icon'],
            issue_ids: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['issue_ids'])),
            key: (string) $data['key'],
            kind: (string) $data['kind'],
            memberships: array_map(static fn (mixed $value): SoftwareMembershipData => SoftwareMembershipData::fromArray(self::objectValue($value)), self::listValue($data['memberships'])),
            metrics: SoftwareResourceMetricsData::fromArray(self::objectValue($data['metrics'])),
            resource_id: (string) $data['resource_id'],
            software_label: (string) $data['software_label'],
            version: $data['version'] === null ? null : (string) $data['version'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['attached_to'] = $this->attached_to === null ? null : $this->attached_to;
        $data['attention'] = $this->attention;
        $data['can_open'] = $this->can_open;
        $data['can_update'] = $this->can_update;
        $data['expected_state'] = $this->expected_state === null ? null : $this->expected_state;
        $data['hosting_mode'] = $this->hosting_mode === null ? null : $this->hosting_mode;
        $data['href'] = $this->href;
        $data['icon'] = $this->icon === null ? null : $this->icon;
        $data['issue_ids'] = $this->issue_ids;
        $data['key'] = $this->key;
        $data['kind'] = $this->kind;
        $data['memberships'] = array_map(static fn (SoftwareMembershipData $value) => $value->toArray(), $this->memberships);
        $data['metrics'] = $this->metrics->toArray();
        $data['resource_id'] = $this->resource_id;
        $data['software_label'] = $this->software_label;
        $data['version'] = $this->version === null ? null : $this->version;

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
