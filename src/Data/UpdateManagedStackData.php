<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\OptionalValue;

final readonly class UpdateManagedStackData
{
    /**
     * @param  array<string, mixed>|OptionalValue  $configuration
     * @param  list<StoreManagedStackMemberData>|OptionalValue  $members
     */
    public function __construct(
        public array|OptionalValue $configuration = OptionalValue::Missing,
        public array|OptionalValue $members = OptionalValue::Missing,
        public string|OptionalValue $name = OptionalValue::Missing,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            configuration: array_key_exists('configuration', $data) ? self::objectValue($data['configuration']) : OptionalValue::Missing,
            members: array_key_exists('members', $data) ? array_map(static fn (mixed $value): StoreManagedStackMemberData => StoreManagedStackMemberData::fromArray(self::objectValue($value)), self::listValue($data['members'])) : OptionalValue::Missing,
            name: array_key_exists('name', $data) ? (string) $data['name'] : OptionalValue::Missing,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->configuration !== OptionalValue::Missing) {
            $data['configuration'] = $this->configuration;
        }
        if ($this->members !== OptionalValue::Missing) {
            $data['members'] = array_map(static fn (StoreManagedStackMemberData $value) => $value->toArray(), $this->members);
        }
        if ($this->name !== OptionalValue::Missing) {
            $data['name'] = $this->name;
        }

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
