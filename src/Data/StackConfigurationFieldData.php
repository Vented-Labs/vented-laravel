<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class StackConfigurationFieldData
{
    /**
     * @param  array<string, mixed>  $labels
     * @param  list<string>  $values
     */
    public function __construct(
        public string $default,
        public string $key,
        public string $label,
        public array $labels,
        public array $values,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            default: (string) $data['default'],
            key: (string) $data['key'],
            label: (string) $data['label'],
            labels: self::objectValue($data['labels']),
            values: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['values'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['default'] = $this->default;
        $data['key'] = $this->key;
        $data['label'] = $this->label;
        $data['labels'] = $this->labels;
        $data['values'] = $this->values;

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
