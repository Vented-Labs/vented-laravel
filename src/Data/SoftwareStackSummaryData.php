<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class SoftwareStackSummaryData
{
    /**
     * @param  list<string>  $issue_ids
     * @param  list<SoftwareStackMemberData>  $members
     * @param  list<SoftwareStackRequirementData>  $requirements
     */
    public function __construct(
        public bool $attention,
        public bool $can_open,
        public bool $can_update,
        public string $definition_revision,
        public StatusData $display_status,
        public string $href,
        public string $icon,
        public string $id,
        public string $identifier,
        public array $issue_ids,
        public array $members,
        public string $name,
        public StatusData $readiness,
        public array $requirements,
        public int $resource_count,
        public StatusData $status,
        public ?string $updated_at,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            attention: (bool) $data['attention'],
            can_open: (bool) $data['can_open'],
            can_update: (bool) $data['can_update'],
            definition_revision: (string) $data['definition_revision'],
            display_status: StatusData::fromArray(self::objectValue($data['display_status'])),
            href: (string) $data['href'],
            icon: (string) $data['icon'],
            id: (string) $data['id'],
            identifier: (string) $data['identifier'],
            issue_ids: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['issue_ids'])),
            members: array_map(static fn (mixed $value): SoftwareStackMemberData => SoftwareStackMemberData::fromArray(self::objectValue($value)), self::listValue($data['members'])),
            name: (string) $data['name'],
            readiness: StatusData::fromArray(self::objectValue($data['readiness'])),
            requirements: array_map(static fn (mixed $value): SoftwareStackRequirementData => SoftwareStackRequirementData::fromArray(self::objectValue($value)), self::listValue($data['requirements'])),
            resource_count: (int) $data['resource_count'],
            status: StatusData::fromArray(self::objectValue($data['status'])),
            updated_at: $data['updated_at'] === null ? null : (string) $data['updated_at'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['attention'] = $this->attention;
        $data['can_open'] = $this->can_open;
        $data['can_update'] = $this->can_update;
        $data['definition_revision'] = $this->definition_revision;
        $data['display_status'] = $this->display_status->toArray();
        $data['href'] = $this->href;
        $data['icon'] = $this->icon;
        $data['id'] = $this->id;
        $data['identifier'] = $this->identifier;
        $data['issue_ids'] = $this->issue_ids;
        $data['members'] = array_map(static fn (SoftwareStackMemberData $value) => $value->toArray(), $this->members);
        $data['name'] = $this->name;
        $data['readiness'] = $this->readiness->toArray();
        $data['requirements'] = array_map(static fn (SoftwareStackRequirementData $value) => $value->toArray(), $this->requirements);
        $data['resource_count'] = $this->resource_count;
        $data['status'] = $this->status->toArray();
        $data['updated_at'] = $this->updated_at === null ? null : $this->updated_at;

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
