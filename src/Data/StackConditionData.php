<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class StackConditionData
{
    /**
     * @param  list<string>  $values
     */
    public function __construct(
        public string $field,
        public array $values,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            field: (string) $data['field'],
            values: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['values'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['field'] = $this->field;
        $data['values'] = $this->values;

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
