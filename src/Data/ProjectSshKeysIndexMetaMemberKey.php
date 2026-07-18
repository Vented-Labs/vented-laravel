<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ProjectSshKeysIndexMetaMemberKey
{
    public function __construct(
        public bool $has_access,
        public string $id,
        public bool $is_own,
        public string $key_type,
        public string $name,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            has_access: (bool) $data['has_access'],
            id: (string) $data['id'],
            is_own: (bool) $data['is_own'],
            key_type: (string) $data['key_type'],
            name: (string) $data['name'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['has_access'] = $this->has_access;
        $data['id'] = $this->id;
        $data['is_own'] = $this->is_own;
        $data['key_type'] = $this->key_type;
        $data['name'] = $this->name;

        return $data;
    }
}
