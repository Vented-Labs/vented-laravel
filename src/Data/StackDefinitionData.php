<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class StackDefinitionData
{
    /**
     * @param  list<StackActionData>  $actions
     * @param  list<StackConfigurationFieldData>  $configuration
     * @param  list<StackRoleData>  $roles
     */
    public function __construct(
        public array $actions,
        public ?string $availability_reason,
        public bool $can_configure,
        public bool $can_provision,
        public array $configuration,
        public string $description,
        public string $icon,
        public string $identifier,
        public bool $link_available,
        public string $name,
        public bool $provision_available,
        public string $revision,
        public array $roles,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            actions: array_map(static fn (mixed $value): StackActionData => StackActionData::fromArray(self::objectValue($value)), self::listValue($data['actions'])),
            availability_reason: $data['availability_reason'] === null ? null : (string) $data['availability_reason'],
            can_configure: (bool) $data['can_configure'],
            can_provision: (bool) $data['can_provision'],
            configuration: array_map(static fn (mixed $value): StackConfigurationFieldData => StackConfigurationFieldData::fromArray(self::objectValue($value)), self::listValue($data['configuration'])),
            description: (string) $data['description'],
            icon: (string) $data['icon'],
            identifier: (string) $data['identifier'],
            link_available: (bool) $data['link_available'],
            name: (string) $data['name'],
            provision_available: (bool) $data['provision_available'],
            revision: (string) $data['revision'],
            roles: array_map(static fn (mixed $value): StackRoleData => StackRoleData::fromArray(self::objectValue($value)), self::listValue($data['roles'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['actions'] = array_map(static fn (StackActionData $value) => $value->toArray(), $this->actions);
        $data['availability_reason'] = $this->availability_reason === null ? null : $this->availability_reason;
        $data['can_configure'] = $this->can_configure;
        $data['can_provision'] = $this->can_provision;
        $data['configuration'] = array_map(static fn (StackConfigurationFieldData $value) => $value->toArray(), $this->configuration);
        $data['description'] = $this->description;
        $data['icon'] = $this->icon;
        $data['identifier'] = $this->identifier;
        $data['link_available'] = $this->link_available;
        $data['name'] = $this->name;
        $data['provision_available'] = $this->provision_available;
        $data['revision'] = $this->revision;
        $data['roles'] = array_map(static fn (StackRoleData $value) => $value->toArray(), $this->roles);

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
