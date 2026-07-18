<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\InstallableType;

final readonly class AppInstallableOption
{
    /**
     * @param  list<FormSchemaField>  $schema
     * @param  list<string>  $versions
     */
    public function __construct(
        public ?AppRuntimeGroupOption $group,
        public ?string $icon,
        public string $identifier,
        public string $name,
        public array $schema,
        public InstallableType $type,
        public array $versions,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            group: $data['group'] === null ? null : AppRuntimeGroupOption::fromArray(self::objectValue($data['group'])),
            icon: $data['icon'] === null ? null : (string) $data['icon'],
            identifier: (string) $data['identifier'],
            name: (string) $data['name'],
            schema: array_map(static fn (mixed $value): FormSchemaField => FormSchemaField::fromArray(self::objectValue($value)), self::listValue($data['schema'])),
            type: InstallableType::from((string) $data['type']),
            versions: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['versions'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['group'] = $this->group === null ? null : $this->group->toArray();
        $data['icon'] = $this->icon === null ? null : $this->icon;
        $data['identifier'] = $this->identifier;
        $data['name'] = $this->name;
        $data['schema'] = array_map(static fn (FormSchemaField $value) => $value->toArray(), $this->schema);
        $data['type'] = $this->type->value;
        $data['versions'] = $this->versions;

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
