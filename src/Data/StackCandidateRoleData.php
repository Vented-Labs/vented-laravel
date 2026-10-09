<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class StackCandidateRoleData
{
    public function __construct(
        public ?string $code,
        public bool $eligible,
        public string $role,
        public bool $shareable,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            code: $data['code'] === null ? null : (string) $data['code'],
            eligible: (bool) $data['eligible'],
            role: (string) $data['role'],
            shareable: (bool) $data['shareable'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['code'] = $this->code === null ? null : $this->code;
        $data['eligible'] = $this->eligible;
        $data['role'] = $this->role;
        $data['shareable'] = $this->shareable;

        return $data;
    }
}
