<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ApiTokenData
{
    /**
     * @param  list<string>  $abilities
     * @param  list<string>|null  $environment_ids
     * @param  list<string>|null  $project_ids
     */
    public function __construct(
        public array $abilities,
        public string $created_at,
        public ?array $environment_ids,
        public ?string $expires_at,
        public string $id,
        public ?string $last_used_at,
        public string $name,
        public ?string $organization_id,
        public ?array $project_ids,
        public StatusData $status,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            abilities: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['abilities'])),
            created_at: (string) $data['created_at'],
            environment_ids: $data['environment_ids'] === null ? null : array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['environment_ids'])),
            expires_at: $data['expires_at'] === null ? null : (string) $data['expires_at'],
            id: (string) $data['id'],
            last_used_at: $data['last_used_at'] === null ? null : (string) $data['last_used_at'],
            name: (string) $data['name'],
            organization_id: $data['organization_id'] === null ? null : (string) $data['organization_id'],
            project_ids: $data['project_ids'] === null ? null : array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['project_ids'])),
            status: StatusData::fromArray(self::objectValue($data['status'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['abilities'] = $this->abilities;
        $data['created_at'] = $this->created_at;
        $data['environment_ids'] = $this->environment_ids === null ? null : $this->environment_ids;
        $data['expires_at'] = $this->expires_at === null ? null : $this->expires_at;
        $data['id'] = $this->id;
        $data['last_used_at'] = $this->last_used_at === null ? null : $this->last_used_at;
        $data['name'] = $this->name;
        $data['organization_id'] = $this->organization_id === null ? null : $this->organization_id;
        $data['project_ids'] = $this->project_ids === null ? null : $this->project_ids;
        $data['status'] = $this->status->toArray();

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

    /**
     * @return list<mixed>
     */
    private static function listValue(mixed $value): array
    {
        if (! is_array($value)) {
            throw new \InvalidArgumentException('Expected an array value.');
        }

        return array_values($value);
    }
}
