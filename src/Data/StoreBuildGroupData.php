<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class StoreBuildGroupData
{
    /**
     * @param  list<string>  $build_config_ids
     */
    public function __construct(
        public array $build_config_ids,
        public string $name,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            build_config_ids: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['build_config_ids'])),
            name: (string) $data['name'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['build_config_ids'] = $this->build_config_ids;
        $data['name'] = $this->name;

        return $data;
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
