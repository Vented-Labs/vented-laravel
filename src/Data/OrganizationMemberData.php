<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\OrganizationRole;

final readonly class OrganizationMemberData
{
    /**
     * @param  list<string>  $granted_project_ids
     */
    public function __construct(
        public bool $all_projects,
        public string $email,
        public array $granted_project_ids,
        public int $granted_projects,
        public string $id,
        public string $name,
        public OrganizationRole $role,
        public ?bool $two_factor_enabled,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            all_projects: (bool) $data['all_projects'],
            email: (string) $data['email'],
            granted_project_ids: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['granted_project_ids'])),
            granted_projects: (int) $data['granted_projects'],
            id: (string) $data['id'],
            name: (string) $data['name'],
            role: OrganizationRole::from((string) $data['role']),
            two_factor_enabled: $data['two_factor_enabled'] === null ? null : (bool) $data['two_factor_enabled'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['all_projects'] = $this->all_projects;
        $data['email'] = $this->email;
        $data['granted_project_ids'] = $this->granted_project_ids;
        $data['granted_projects'] = $this->granted_projects;
        $data['id'] = $this->id;
        $data['name'] = $this->name;
        $data['role'] = $this->role->value;
        $data['two_factor_enabled'] = $this->two_factor_enabled === null ? null : $this->two_factor_enabled;

        return $data;
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
