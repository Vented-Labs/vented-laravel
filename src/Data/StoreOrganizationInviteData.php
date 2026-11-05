<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\OrganizationRole;

final readonly class StoreOrganizationInviteData
{
    /**
     * @param  list<string>  $project_ids
     */
    public function __construct(
        public bool $all_projects,
        public string $email,
        public array $project_ids,
        public OrganizationRole $role,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            all_projects: (bool) $data['all_projects'],
            email: (string) $data['email'],
            project_ids: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['project_ids'])),
            role: OrganizationRole::from((string) $data['role']),
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
        $data['project_ids'] = $this->project_ids;
        $data['role'] = $this->role->value;

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
