<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class BuildTriggersMeta
{
    /**
     * @param  list<FormOption>  $types
     */
    public function __construct(
        public BuildConfigData $build_config,
        public array $types,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            build_config: BuildConfigData::fromArray(self::objectValue($data['build_config'])),
            types: array_map(static fn (mixed $value): FormOption => FormOption::fromArray(self::objectValue($value)), self::listValue($data['types'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['build_config'] = $this->build_config->toArray();
        $data['types'] = array_map(static fn (FormOption $value) => $value->toArray(), $this->types);

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
