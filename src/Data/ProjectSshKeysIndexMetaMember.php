<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ProjectSshKeysIndexMetaMember
{
    /**
     * @param  list<ProjectSshKeysIndexMetaMemberKey>  $keys
     */
    public function __construct(
        public array $keys,
        public UserRef $member,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            keys: array_map(static fn (mixed $value): ProjectSshKeysIndexMetaMemberKey => ProjectSshKeysIndexMetaMemberKey::fromArray(self::objectValue($value)), self::listValue($data['keys'])),
            member: UserRef::fromArray(self::objectValue($data['member'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['keys'] = array_map(static fn (ProjectSshKeysIndexMetaMemberKey $value) => $value->toArray(), $this->keys);
        $data['member'] = $this->member->toArray();

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
