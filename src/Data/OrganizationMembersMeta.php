<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class OrganizationMembersMeta
{
    /**
     * @param  list<array<string, mixed>>  $pending_invites
     * @param  list<FormOption>  $projects
     * @param  list<FormOption>  $roles
     */
    public function __construct(
        public bool $can_manage_members,
        public string $organization_id,
        public string $organization_name,
        public array $pending_invites,
        public array $projects,
        public array $roles,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            can_manage_members: (bool) $data['can_manage_members'],
            organization_id: (string) $data['organization_id'],
            organization_name: (string) $data['organization_name'],
            pending_invites: array_map(static fn (mixed $value): array => self::objectValue($value), self::listValue($data['pending_invites'])),
            projects: array_map(static fn (mixed $value): FormOption => FormOption::fromArray(self::objectValue($value)), self::listValue($data['projects'])),
            roles: array_map(static fn (mixed $value): FormOption => FormOption::fromArray(self::objectValue($value)), self::listValue($data['roles'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['can_manage_members'] = $this->can_manage_members;
        $data['organization_id'] = $this->organization_id;
        $data['organization_name'] = $this->organization_name;
        $data['pending_invites'] = $this->pending_invites;
        $data['projects'] = array_map(static fn (FormOption $value) => $value->toArray(), $this->projects);
        $data['roles'] = array_map(static fn (FormOption $value) => $value->toArray(), $this->roles);

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
