<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class AppStorageMetaFormOptions
{
    /**
     * @param  list<string>  $mount_defaults
     * @param  list<FormOption>  $storages
     */
    public function __construct(
        public int $minimum_volumes,
        public array $mount_defaults,
        public bool $requirements_available,
        public array $storages,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            minimum_volumes: (int) $data['minimum_volumes'],
            mount_defaults: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['mount_defaults'])),
            requirements_available: (bool) $data['requirements_available'],
            storages: array_map(static fn (mixed $value): FormOption => FormOption::fromArray(self::objectValue($value)), self::listValue($data['storages'])),
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
        $data['requirements_available'] = $this->requirements_available;
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
