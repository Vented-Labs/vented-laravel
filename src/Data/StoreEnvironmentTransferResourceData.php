<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\EnvironmentTransferResourceType;

final readonly class StoreEnvironmentTransferResourceData
{
    /**
     * @param  list<string>  $selected_secret_fields
     */
    public function __construct(
        public array $selected_secret_fields,
        public string $source_resource_id,
        public EnvironmentTransferResourceType $type,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            selected_secret_fields: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['selected_secret_fields'])),
            source_resource_id: (string) $data['source_resource_id'],
            type: EnvironmentTransferResourceType::from((string) $data['type']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['selected_secret_fields'] = $this->selected_secret_fields;
        $data['source_resource_id'] = $this->source_resource_id;
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
