<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\OrganizationRole;

final readonly class OrganizationData
{
    public function __construct(
        public string $id,
        public int $members_count,
        public string $name,
        public string $owner_name,
        public int $projects_count,
        public ?OrganizationRole $role,
        public string $slug,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: (string) $data['id'],
            members_count: (int) $data['members_count'],
            name: (string) $data['name'],
            owner_name: (string) $data['owner_name'],
            projects_count: (int) $data['projects_count'],
            role: $data['role'] === null ? null : OrganizationRole::from((string) $data['role']),
            slug: (string) $data['slug'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['id'] = $this->id;
        $data['members_count'] = $this->members_count;
        $data['name'] = $this->name;
        $data['owner_name'] = $this->owner_name;
        $data['projects_count'] = $this->projects_count;
        $data['role'] = $this->role === null ? null : $this->role->value;
        $data['slug'] = $this->slug;

        return $data;
    }
}
