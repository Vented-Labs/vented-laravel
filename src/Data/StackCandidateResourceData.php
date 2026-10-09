<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class StackCandidateResourceData
{
    /**
     * @param  list<StackCandidateRoleData>  $roles
     */
    public function __construct(
        public string $kind,
        public string $resource_id,
        public array $roles,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            kind: (string) $data['kind'],
            resource_id: (string) $data['resource_id'],
            roles: array_map(static fn (mixed $value): StackCandidateRoleData => StackCandidateRoleData::fromArray(self::objectValue($value)), self::listValue($data['roles'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['kind'] = $this->kind;
        $data['resource_id'] = $this->resource_id;
        $data['roles'] = array_map(static fn (StackCandidateRoleData $value) => $value->toArray(), $this->roles);

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
