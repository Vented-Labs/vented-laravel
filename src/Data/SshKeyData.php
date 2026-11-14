<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class SshKeyData
{
    public function __construct(
        public string $created_at,
        public string $id,
        public string $key_type,
        public string $masked_public_key,
        public string $name,
        public string $public_key,
        public bool $visible_to_others,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            created_at: (string) $data['created_at'],
            id: (string) $data['id'],
            key_type: (string) $data['key_type'],
            masked_public_key: (string) $data['masked_public_key'],
            name: (string) $data['name'],
            public_key: (string) $data['public_key'],
            visible_to_others: (bool) $data['visible_to_others'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['created_at'] = $this->created_at;
        $data['id'] = $this->id;
        $data['key_type'] = $this->key_type;
        $data['masked_public_key'] = $this->masked_public_key;
        $data['name'] = $this->name;
        $data['public_key'] = $this->public_key;
        $data['visible_to_others'] = $this->visible_to_others;

        return $data;
    }
}
