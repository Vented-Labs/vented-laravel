<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class EnvironmentSshKeyData
{
    public function __construct(
        public string $environment_id,
        public string $granted_at,
        public string $id,
        public string $key_type,
        public string $masked_public_key,
        public string $name,
        public UserRef $owner,
        public string $project_id,
        public string $ssh_key_id,
        public string $status,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            environment_id: (string) $data['environment_id'],
            granted_at: (string) $data['granted_at'],
            id: (string) $data['id'],
            key_type: (string) $data['key_type'],
            masked_public_key: (string) $data['masked_public_key'],
            name: (string) $data['name'],
            owner: UserRef::fromArray(self::objectValue($data['owner'])),
            project_id: (string) $data['project_id'],
            ssh_key_id: (string) $data['ssh_key_id'],
            status: (string) $data['status'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['environment_id'] = $this->environment_id;
        $data['granted_at'] = $this->granted_at;
        $data['id'] = $this->id;
        $data['key_type'] = $this->key_type;
        $data['masked_public_key'] = $this->masked_public_key;
        $data['name'] = $this->name;
        $data['owner'] = $this->owner->toArray();
        $data['project_id'] = $this->project_id;
        $data['ssh_key_id'] = $this->ssh_key_id;
        $data['status'] = $this->status;

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
