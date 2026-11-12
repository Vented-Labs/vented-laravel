<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class FlowStepData
{
    /**
     * @param  list<FlowFieldData>  $fields
     */
    public function __construct(
        public ?string $description,
        public array $fields,
        public string $id,
        public string $stage,
        public string $title,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            description: $data['description'] === null ? null : (string) $data['description'],
            fields: array_map(static fn (mixed $value): FlowFieldData => FlowFieldData::fromArray(self::objectValue($value)), self::listValue($data['fields'])),
            id: (string) $data['id'],
            stage: (string) $data['stage'],
            title: (string) $data['title'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['description'] = $this->description === null ? null : $this->description;
        $data['fields'] = array_map(static fn (FlowFieldData $value) => $value->toArray(), $this->fields);
        $data['id'] = $this->id;
        $data['stage'] = $this->stage;
        $data['title'] = $this->title;

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
