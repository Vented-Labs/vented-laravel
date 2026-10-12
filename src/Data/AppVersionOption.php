<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class AppVersionOption
{
    /**
     * @param  list<string>  $mount_defaults
     * @param  list<FormSchemaField>  $schema
     */
    public function __construct(
        public int $minimum_volumes,
        public array $mount_defaults,
        public array $schema,
        public string $version,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            minimum_volumes: (int) $data['minimum_volumes'],
            mount_defaults: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['mount_defaults'])),
            schema: array_map(static fn (mixed $value): FormSchemaField => FormSchemaField::fromArray(self::objectValue($value)), self::listValue($data['schema'])),
            version: (string) $data['version'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['minimum_volumes'] = $this->minimum_volumes;
        $data['mount_defaults'] = $this->mount_defaults;
        $data['schema'] = array_map(static fn (FormSchemaField $value) => $value->toArray(), $this->schema);
        $data['version'] = $this->version;

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
