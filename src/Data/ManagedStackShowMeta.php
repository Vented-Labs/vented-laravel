<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ManagedStackShowMeta
{
    /**
     * @param  list<StackResourceOptionData>  $resources
     */
    public function __construct(
        public bool $can_update,
        public ?string $catalog_error,
        public ?StackDefinitionData $definition,
        public array $resources,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            can_update: (bool) $data['can_update'],
            catalog_error: $data['catalog_error'] === null ? null : (string) $data['catalog_error'],
            definition: $data['definition'] === null ? null : StackDefinitionData::fromArray(self::objectValue($data['definition'])),
            resources: array_map(static fn (mixed $value): StackResourceOptionData => StackResourceOptionData::fromArray(self::objectValue($value)), self::listValue($data['resources'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['can_update'] = $this->can_update;
        $data['catalog_error'] = $this->catalog_error === null ? null : $this->catalog_error;
        $data['definition'] = $this->definition === null ? null : $this->definition->toArray();
        $data['resources'] = array_map(static fn (StackResourceOptionData $value) => $value->toArray(), $this->resources);

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
