<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class StoreManagedStackData
{
    /**
     * @param  array<string, mixed>  $configuration
     * @param  list<StoreManagedStackMemberData>  $members
     */
    public function __construct(
        public array $configuration,
        public string $definition_revision,
        public array $members,
        public string $name,
        public string $stack_identifier,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            configuration: self::objectValue($data['configuration']),
            definition_revision: (string) $data['definition_revision'],
            members: array_map(static fn (mixed $value): StoreManagedStackMemberData => StoreManagedStackMemberData::fromArray(self::objectValue($value)), self::listValue($data['members'])),
            name: (string) $data['name'],
            stack_identifier: (string) $data['stack_identifier'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['configuration'] = $this->configuration;
        $data['definition_revision'] = $this->definition_revision;
        $data['members'] = array_map(static fn (StoreManagedStackMemberData $value) => $value->toArray(), $this->members);
        $data['name'] = $this->name;
        $data['stack_identifier'] = $this->stack_identifier;

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
