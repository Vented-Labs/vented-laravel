<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ManagedStackData
{
    /**
     * @param  array<string, mixed>  $configuration
     * @param  list<ManagedStackMemberData>  $members
     */
    public function __construct(
        public ?ManagedStackCleanupStateData $cleanup,
        public array $configuration,
        public string $created_at,
        public string $definition_name,
        public string $definition_revision,
        public string $icon,
        public string $id,
        public array $members,
        public string $name,
        public string $stack_identifier,
        public StatusData $status,
        public string $updated_at,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            cleanup: $data['cleanup'] === null ? null : ManagedStackCleanupStateData::fromArray(self::objectValue($data['cleanup'])),
            configuration: self::objectValue($data['configuration']),
            created_at: (string) $data['created_at'],
            definition_name: (string) $data['definition_name'],
            definition_revision: (string) $data['definition_revision'],
            icon: (string) $data['icon'],
            id: (string) $data['id'],
            members: array_map(static fn (mixed $value): ManagedStackMemberData => ManagedStackMemberData::fromArray(self::objectValue($value)), self::listValue($data['members'])),
            name: (string) $data['name'],
            stack_identifier: (string) $data['stack_identifier'],
            status: StatusData::fromArray(self::objectValue($data['status'])),
            updated_at: (string) $data['updated_at'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['cleanup'] = $this->cleanup === null ? null : $this->cleanup->toArray();
        $data['configuration'] = $this->configuration;
        $data['created_at'] = $this->created_at;
        $data['definition_name'] = $this->definition_name;
        $data['definition_revision'] = $this->definition_revision;
        $data['icon'] = $this->icon;
        $data['id'] = $this->id;
        $data['members'] = array_map(static fn (ManagedStackMemberData $value) => $value->toArray(), $this->members);
        $data['name'] = $this->name;
        $data['stack_identifier'] = $this->stack_identifier;
        $data['status'] = $this->status->toArray();
        $data['updated_at'] = $this->updated_at;

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
