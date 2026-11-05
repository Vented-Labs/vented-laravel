<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class SoftwareMembershipData
{
    public function __construct(
        public bool $required,
        public string $role,
        public string $role_label,
        public bool $shareable,
        public string $stack_href,
        public string $stack_id,
        public string $stack_name,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            required: (bool) $data['required'],
            role: (string) $data['role'],
            role_label: (string) $data['role_label'],
            shareable: (bool) $data['shareable'],
            stack_href: (string) $data['stack_href'],
            stack_id: (string) $data['stack_id'],
            stack_name: (string) $data['stack_name'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['required'] = $this->required;
        $data['role'] = $this->role;
        $data['role_label'] = $this->role_label;
        $data['shareable'] = $this->shareable;
        $data['stack_href'] = $this->stack_href;
        $data['stack_id'] = $this->stack_id;
        $data['stack_name'] = $this->stack_name;

        return $data;
    }
}
