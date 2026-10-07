<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\ProjectRole;

final readonly class ProjectMemberData
{
    public function __construct(
        public string $email,
        public string $id,
        public bool $is_owner,
        public string $name,
        public ProjectRole $role,
        public ?bool $two_factor_enabled,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            email: (string) $data['email'],
            id: (string) $data['id'],
            is_owner: (bool) $data['is_owner'],
            name: (string) $data['name'],
            role: ProjectRole::from((string) $data['role']),
            two_factor_enabled: $data['two_factor_enabled'] === null ? null : (bool) $data['two_factor_enabled'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['email'] = $this->email;
        $data['id'] = $this->id;
        $data['is_owner'] = $this->is_owner;
        $data['name'] = $this->name;
        $data['role'] = $this->role->value;
        $data['two_factor_enabled'] = $this->two_factor_enabled === null ? null : $this->two_factor_enabled;

        return $data;
    }
}
