<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\OptionalValue;

final readonly class UpdateEnvironmentTransferPresetData
{
    /**
     * @param  list<StoreEnvironmentTransferPresetResourceData>|OptionalValue  $resources
     */
    public function __construct(
        public string|OptionalValue $name = OptionalValue::Missing,
        public array|OptionalValue $resources = OptionalValue::Missing,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            name: array_key_exists('name', $data) ? (string) $data['name'] : OptionalValue::Missing,
            resources: array_key_exists('resources', $data) ? array_map(static fn (mixed $value): StoreEnvironmentTransferPresetResourceData => StoreEnvironmentTransferPresetResourceData::fromArray(self::objectValue($value)), self::listValue($data['resources'])) : OptionalValue::Missing,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->name !== OptionalValue::Missing) {
            $data['name'] = $this->name;
        }
        if ($this->resources !== OptionalValue::Missing) {
            $data['resources'] = array_map(static fn (StoreEnvironmentTransferPresetResourceData $value) => $value->toArray(), $this->resources);
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
