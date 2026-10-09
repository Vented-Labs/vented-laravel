<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ManagedStacksFormOptions
{
    /**
     * @param  list<StackDefinitionData>  $definitions
     * @param  list<StackResourceOptionData>  $resources
     */
    public function __construct(
        public array $definitions,
        public array $resources,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            definitions: array_map(static fn (mixed $value): StackDefinitionData => StackDefinitionData::fromArray(self::objectValue($value)), self::listValue($data['definitions'])),
            resources: array_map(static fn (mixed $value): StackResourceOptionData => StackResourceOptionData::fromArray(self::objectValue($value)), self::listValue($data['resources'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['definitions'] = array_map(static fn (StackDefinitionData $value) => $value->toArray(), $this->definitions);
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
