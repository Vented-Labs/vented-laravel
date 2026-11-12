<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class UpdateFlowData
{
    /**
     * @param  array<string, mixed>  $values
     */
    public function __construct(
        public string $step,
        public array $values,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            step: (string) $data['step'],
            values: self::objectValue($data['values']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['step'] = $this->step;
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
}
