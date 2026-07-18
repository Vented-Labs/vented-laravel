<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\ProjectRole;

final readonly class ProjectInviteData
{
    public function __construct(
        public string $created_at,
        public string $email,
        public string $expires_at,
        public string $id,
        public ?string $inviter_name,
        public ProjectRole $role,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            created_at: (string) $data['created_at'],
            email: (string) $data['email'],
            expires_at: (string) $data['expires_at'],
            id: (string) $data['id'],
            inviter_name: $data['inviter_name'] === null ? null : (string) $data['inviter_name'],
            role: ProjectRole::from((string) $data['role']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['created_at'] = $this->created_at;
        $data['email'] = $this->email;
        $data['expires_at'] = $this->expires_at;
        $data['id'] = $this->id;
        $data['inviter_name'] = $this->inviter_name === null ? null : $this->inviter_name;
        $data['role'] = $this->role->value;

        return $data;
    }
}
