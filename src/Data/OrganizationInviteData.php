<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\OrganizationRole;

final readonly class OrganizationInviteData
{
    public function __construct(
        public bool $all_projects,
        public string $email,
        public string $expires_at,
        public string $id,
        public ?string $inviter_name,
        public string $organization_id,
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
            expires_at: (string) $data['expires_at'],
            id: (string) $data['id'],
            inviter_name: $data['inviter_name'] === null ? null : (string) $data['inviter_name'],
            organization_id: (string) $data['organization_id'],
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
        $data['expires_at'] = $this->expires_at;
        $data['id'] = $this->id;
        $data['inviter_name'] = $this->inviter_name === null ? null : $this->inviter_name;
        $data['organization_id'] = $this->organization_id;
        $data['role'] = $this->role->value;

        return $data;
    }
}
