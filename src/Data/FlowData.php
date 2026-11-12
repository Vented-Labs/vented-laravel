<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class FlowData
{
    /**
     * @param  list<string>  $completed_steps
     * @param  list<FlowStepData>  $steps
     * @param  array<string, mixed>  $values
     */
    public function __construct(
        public array $completed_steps,
        public string $id,
        public array $steps,
        public string $title,
        public array $values,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            completed_steps: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['completed_steps'])),
            id: (string) $data['id'],
            steps: array_map(static fn (mixed $value): FlowStepData => FlowStepData::fromArray(self::objectValue($value)), self::listValue($data['steps'])),
            title: (string) $data['title'],
            values: self::objectValue($data['values']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['completed_steps'] = $this->completed_steps;
        $data['id'] = $this->id;
        $data['steps'] = array_map(static fn (FlowStepData $value) => $value->toArray(), $this->steps);
        $data['title'] = $this->title;
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
