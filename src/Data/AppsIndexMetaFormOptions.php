<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class AppsIndexMetaFormOptions
{
    /**
     * @param  list<AppInstallableOption>  $addons
     * @param  list<AppInstallableOption>  $runtimes
     * @param  list<FormOption>  $storages
     */
    public function __construct(
        public array $addons,
        public array $runtimes,
        public array $storages,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            addons: array_map(static fn (mixed $value): AppInstallableOption => AppInstallableOption::fromArray(self::objectValue($value)), self::listValue($data['addons'])),
            runtimes: array_map(static fn (mixed $value): AppInstallableOption => AppInstallableOption::fromArray(self::objectValue($value)), self::listValue($data['runtimes'])),
            storages: array_map(static fn (mixed $value): FormOption => FormOption::fromArray(self::objectValue($value)), self::listValue($data['storages'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['addons'] = array_map(static fn (AppInstallableOption $value) => $value->toArray(), $this->addons);
        $data['runtimes'] = array_map(static fn (AppInstallableOption $value) => $value->toArray(), $this->runtimes);
        $data['storages'] = array_map(static fn (FormOption $value) => $value->toArray(), $this->storages);

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
