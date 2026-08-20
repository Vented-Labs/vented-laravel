<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class StoreEnvironmentTransferPresetData
{
    /**
     * @param  list<StoreEnvironmentTransferPresetResourceData>  $resources
     */
    public function __construct(
        public string $name,
        public array $resources,
        public string $source_environment_id,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            name: (string) $data['name'],
            resources: array_map(static fn (mixed $value): StoreEnvironmentTransferPresetResourceData => StoreEnvironmentTransferPresetResourceData::fromArray(self::objectValue($value)), self::listValue($data['resources'])),
            source_environment_id: (string) $data['source_environment_id'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['name'] = $this->name;
        $data['resources'] = array_map(static fn (StoreEnvironmentTransferPresetResourceData $value) => $value->toArray(), $this->resources);
        $data['source_environment_id'] = $this->source_environment_id;

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
