<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class AppConfigurationMetaFormOptions
{
    /**
     * @param  list<FormSchemaField>  $schema
     * @param  list<FormOption>  $storages
     * @param  list<AppVersionOption>  $version_options
     * @param  list<string>  $versions
     */
    public function __construct(
        public array $schema,
        public array $storages,
        public array $version_options,
        public array $versions,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            schema: array_map(static fn (mixed $value): FormSchemaField => FormSchemaField::fromArray(self::objectValue($value)), self::listValue($data['schema'])),
            storages: array_map(static fn (mixed $value): FormOption => FormOption::fromArray(self::objectValue($value)), self::listValue($data['storages'])),
            version_options: array_map(static fn (mixed $value): AppVersionOption => AppVersionOption::fromArray(self::objectValue($value)), self::listValue($data['version_options'])),
            versions: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['versions'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['schema'] = array_map(static fn (FormSchemaField $value) => $value->toArray(), $this->schema);
        $data['storages'] = array_map(static fn (FormOption $value) => $value->toArray(), $this->storages);
        $data['version_options'] = array_map(static fn (AppVersionOption $value) => $value->toArray(), $this->version_options);
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
