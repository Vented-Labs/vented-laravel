<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class EnvironmentTransferPresetData
{
    /**
     * @param  list<EnvironmentTransferPresetResourceData>  $resources
     */
    public function __construct(
        public string $created_at,
        public string $id,
        public string $name,
        public array $resources,
        public string $source_environment_id,
        public string $target_environment_id,
        public string $updated_at,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            created_at: (string) $data['created_at'],
            id: (string) $data['id'],
            name: (string) $data['name'],
            resources: array_map(static fn (mixed $value): EnvironmentTransferPresetResourceData => EnvironmentTransferPresetResourceData::fromArray(self::objectValue($value)), self::listValue($data['resources'])),
            source_environment_id: (string) $data['source_environment_id'],
            target_environment_id: (string) $data['target_environment_id'],
            updated_at: (string) $data['updated_at'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['created_at'] = $this->created_at;
        $data['id'] = $this->id;
        $data['name'] = $this->name;
        $data['resources'] = array_map(static fn (EnvironmentTransferPresetResourceData $value) => $value->toArray(), $this->resources);
        $data['source_environment_id'] = $this->source_environment_id;
        $data['target_environment_id'] = $this->target_environment_id;
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
