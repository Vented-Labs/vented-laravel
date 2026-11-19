<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\OptionalValue;

final readonly class StoreApiTokenData
{
    /**
     * @param  list<string>  $abilities
     * @param  list<string>|null|OptionalValue  $environment_ids
     * @param  list<string>|null|OptionalValue  $project_ids
     */
    public function __construct(
        public array $abilities,
        public string $expires_at,
        public string $name,
        public array|null|OptionalValue $environment_ids = OptionalValue::Missing,
        public string|null|OptionalValue $organization_id = OptionalValue::Missing,
        public array|null|OptionalValue $project_ids = OptionalValue::Missing,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            abilities: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['abilities'])),
            expires_at: (string) $data['expires_at'],
            name: (string) $data['name'],
            environment_ids: array_key_exists('environment_ids', $data) ? $data['environment_ids'] === null ? null : array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['environment_ids'])) : OptionalValue::Missing,
            organization_id: array_key_exists('organization_id', $data) ? $data['organization_id'] === null ? null : (string) $data['organization_id'] : OptionalValue::Missing,
            project_ids: array_key_exists('project_ids', $data) ? $data['project_ids'] === null ? null : array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['project_ids'])) : OptionalValue::Missing,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['abilities'] = $this->abilities;
        $data['expires_at'] = $this->expires_at;
        $data['name'] = $this->name;
        if ($this->environment_ids !== OptionalValue::Missing) {
            $data['environment_ids'] = $this->environment_ids === null ? null : $this->environment_ids;
        }
        if ($this->organization_id !== OptionalValue::Missing) {
            $data['organization_id'] = $this->organization_id === null ? null : $this->organization_id;
        }
        if ($this->project_ids !== OptionalValue::Missing) {
            $data['project_ids'] = $this->project_ids === null ? null : $this->project_ids;
        }

        return $data;
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
