<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class AppBindingsIndexMetaFormOptions
{
    /**
     * @param  list<AppBindingsTargetOption>  $apps
     * @param  list<FormOption>  $bindable_types
     * @param  list<FormOption>  $port_types
     * @param  list<AppBindingsTargetOption>  $services
     */
    public function __construct(
        public array $apps,
        public array $bindable_types,
        public array $port_types,
        public array $services,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            apps: array_map(static fn (mixed $value): AppBindingsTargetOption => AppBindingsTargetOption::fromArray(self::objectValue($value)), self::listValue($data['apps'])),
            bindable_types: array_map(static fn (mixed $value): FormOption => FormOption::fromArray(self::objectValue($value)), self::listValue($data['bindable_types'])),
            port_types: array_map(static fn (mixed $value): FormOption => FormOption::fromArray(self::objectValue($value)), self::listValue($data['port_types'])),
            services: array_map(static fn (mixed $value): AppBindingsTargetOption => AppBindingsTargetOption::fromArray(self::objectValue($value)), self::listValue($data['services'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['apps'] = array_map(static fn (AppBindingsTargetOption $value) => $value->toArray(), $this->apps);
        $data['bindable_types'] = array_map(static fn (FormOption $value) => $value->toArray(), $this->bindable_types);
        $data['port_types'] = array_map(static fn (FormOption $value) => $value->toArray(), $this->port_types);
        $data['services'] = array_map(static fn (AppBindingsTargetOption $value) => $value->toArray(), $this->services);

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
