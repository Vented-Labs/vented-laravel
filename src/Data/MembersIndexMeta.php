<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class MembersIndexMeta
{
    /**
     * @param  list<array<string, mixed>>  $pending_invites
     */
    public function __construct(
        public bool $is_owner,
        public array $pending_invites,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            is_owner: (bool) $data['is_owner'],
            pending_invites: array_map(static fn (mixed $value): array => self::objectValue($value), self::listValue($data['pending_invites'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['is_owner'] = $this->is_owner;
        $data['pending_invites'] = $this->pending_invites;

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
