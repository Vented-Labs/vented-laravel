<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class AccountOverviewMetaDangerZone
{
    public function __construct(
        public bool $can_delete_account,
        public int $owned_project_count,
        public bool $requires_password_confirmation,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            can_delete_account: (bool) $data['can_delete_account'],
            owned_project_count: (int) $data['owned_project_count'],
            requires_password_confirmation: (bool) $data['requires_password_confirmation'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['can_delete_account'] = $this->can_delete_account;
        $data['owned_project_count'] = $this->owned_project_count;
        $data['requires_password_confirmation'] = $this->requires_password_confirmation;

        return $data;
    }
}
