<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ProjectSshKeyData
{
    public function __construct(
        public string $granted_at,
        public string $key_type,
        public string $masked_public_key,
        public string $name,
        public UserRef $owner,
        public string $project_id,
        public string $ssh_key_id,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            granted_at: (string) $data['granted_at'],
            key_type: (string) $data['key_type'],
            masked_public_key: (string) $data['masked_public_key'],
            name: (string) $data['name'],
            owner: UserRef::fromArray(self::objectValue($data['owner'])),
            project_id: (string) $data['project_id'],
            ssh_key_id: (string) $data['ssh_key_id'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['granted_at'] = $this->granted_at;
        $data['key_type'] = $this->key_type;
        $data['masked_public_key'] = $this->masked_public_key;
        $data['name'] = $this->name;
        $data['owner'] = $this->owner->toArray();
        $data['project_id'] = $this->project_id;
        $data['ssh_key_id'] = $this->ssh_key_id;

        return $data;
    }

    /**
     * @return array<string, mixed>
     */
    private static function objectValue(mixed $value): array
    {
        if (! is_array($value)) {
            throw new \InvalidArgumentException('Expected an object value.');
        }

        /** @var array<string, mixed> $value */
        return $value;
    }
}
