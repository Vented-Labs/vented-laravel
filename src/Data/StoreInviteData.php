<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\ProjectRole;

final readonly class StoreInviteData
{
    public function __construct(
        public string $email,
        public ProjectRole $role,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            email: (string) $data['email'],
            role: ProjectRole::from((string) $data['role']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['email'] = $this->email;
        $data['role'] = $this->role->value;

        return $data;
    }
}
