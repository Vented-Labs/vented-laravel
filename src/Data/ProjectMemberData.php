<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ProjectMemberData
{
    public function __construct(
        public string $email,
        public string $id,
        public bool $is_owner,
        public string $name,
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

        return $data;
    }
}
