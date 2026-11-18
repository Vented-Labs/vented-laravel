<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\OptionalValue;

final readonly class UpdateBuildGroupData
{
    /**
     * @param  list<string>|OptionalValue  $build_config_ids
     */
    public function __construct(
        public array|OptionalValue $build_config_ids = OptionalValue::Missing,
        public string|OptionalValue $name = OptionalValue::Missing,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            build_config_ids: array_key_exists('build_config_ids', $data) ? array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['build_config_ids'])) : OptionalValue::Missing,
            name: array_key_exists('name', $data) ? (string) $data['name'] : OptionalValue::Missing,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->build_config_ids !== OptionalValue::Missing) {
            $data['build_config_ids'] = $this->build_config_ids;
        }
        if ($this->name !== OptionalValue::Missing) {
            $data['name'] = $this->name;
        }

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
