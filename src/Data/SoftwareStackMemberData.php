<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class SoftwareStackMemberData
{
    public function __construct(
        public bool $required,
        public string $resource_key,
        public string $role,
        public string $role_label,
        public bool $shareable,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            required: (bool) $data['required'],
            resource_key: (string) $data['resource_key'],
            role: (string) $data['role'],
            role_label: (string) $data['role_label'],
            shareable: (bool) $data['shareable'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['required'] = $this->required;
        $data['resource_key'] = $this->resource_key;
        $data['role'] = $this->role;
        $data['role_label'] = $this->role_label;
        $data['shareable'] = $this->shareable;

        return $data;
    }
}
