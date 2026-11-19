<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ApiTokenReachableProjectData
{
    /**
     * @param  list<FormOption>  $environments
     */
    public function __construct(
        public array $environments,
        public string $id,
        public string $name,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            environments: array_map(static fn (mixed $value): FormOption => FormOption::fromArray(self::objectValue($value)), self::listValue($data['environments'])),
            id: (string) $data['id'],
            name: (string) $data['name'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['environments'] = array_map(static fn (FormOption $value) => $value->toArray(), $this->environments);
        $data['id'] = $this->id;
        $data['name'] = $this->name;

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
