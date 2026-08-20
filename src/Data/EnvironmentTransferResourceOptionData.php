<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\EnvironmentTransferResourceType;

final readonly class EnvironmentTransferResourceOptionData
{
    /**
     * @param  list<string>  $secret_fields
     */
    public function __construct(
        public ?string $description,
        public string $id,
        public string $name,
        public ?string $parent_id,
        public array $secret_fields,
        public EnvironmentTransferResourceType $type,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            description: $data['description'] === null ? null : (string) $data['description'],
            id: (string) $data['id'],
            name: (string) $data['name'],
            parent_id: $data['parent_id'] === null ? null : (string) $data['parent_id'],
            secret_fields: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['secret_fields'])),
            type: EnvironmentTransferResourceType::from((string) $data['type']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['description'] = $this->description === null ? null : $this->description;
        $data['id'] = $this->id;
        $data['name'] = $this->name;
        $data['parent_id'] = $this->parent_id === null ? null : $this->parent_id;
        $data['secret_fields'] = $this->secret_fields;
        $data['type'] = $this->type->value;

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
