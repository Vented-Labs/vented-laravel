<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ManagedStackMemberData
{
    public function __construct(
        public string $id,
        public string $kind,
        public string $name,
        public string $resource_id,
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
            id: (string) $data['id'],
            kind: (string) $data['kind'],
            name: (string) $data['name'],
            resource_id: (string) $data['resource_id'],
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
        $data['id'] = $this->id;
        $data['kind'] = $this->kind;
        $data['name'] = $this->name;
        $data['resource_id'] = $this->resource_id;
        $data['role'] = $this->role;
        $data['role_label'] = $this->role_label;
        $data['shareable'] = $this->shareable;

        return $data;
    }
}
