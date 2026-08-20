<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\EnvironmentTransferAction;

final readonly class UpdateEnvironmentTransferDecisionData
{
    /**
     * @param  array<string, mixed>  $resolution
     * @param  list<string>  $selected_secret_fields
     */
    public function __construct(
        public EnvironmentTransferAction $action,
        public string $item_id,
        public array $resolution,
        public array $selected_secret_fields,
        public ?string $target_resource_id,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            action: EnvironmentTransferAction::from((string) $data['action']),
            item_id: (string) $data['item_id'],
            resolution: self::objectValue($data['resolution']),
            selected_secret_fields: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['selected_secret_fields'])),
            target_resource_id: $data['target_resource_id'] === null ? null : (string) $data['target_resource_id'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['action'] = $this->action->value;
        $data['item_id'] = $this->item_id;
        $data['resolution'] = $this->resolution;
        $data['selected_secret_fields'] = $this->selected_secret_fields;
        $data['target_resource_id'] = $this->target_resource_id === null ? null : $this->target_resource_id;

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
