<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\EnvironmentTransferAction;
use Vented\Enums\EnvironmentTransferItemStatus;
use Vented\Enums\EnvironmentTransferResourceType;

final readonly class EnvironmentTransferItemData
{
    /**
     * @param  list<string>  $allowed_actions
     * @param  list<string>  $conflicts
     * @param  array<string, mixed>  $diff
     * @param  list<string>  $errors
     * @param  array<string, mixed>  $resolution
     * @param  list<string>  $secret_fields
     * @param  list<string>  $selected_secret_fields
     * @param  array<string, mixed>  $specification
     * @param  list<string>  $target_options
     * @param  list<string>  $warnings
     */
    public function __construct(
        public EnvironmentTransferAction $action,
        public string $action_label,
        public array $allowed_actions,
        public ?string $applied_at,
        public array $conflicts,
        public array $diff,
        public array $errors,
        public string $id,
        public array $resolution,
        public EnvironmentTransferResourceType $resource_type,
        public string $resource_type_label,
        public array $secret_fields,
        public array $selected_secret_fields,
        public string $source_resource_id,
        public array $specification,
        public EnvironmentTransferItemStatus $status,
        public string $status_color,
        public string $status_label,
        public array $target_options,
        public ?string $target_resource_id,
        public array $warnings,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            action: EnvironmentTransferAction::from((string) $data['action']),
            action_label: (string) $data['action_label'],
            allowed_actions: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['allowed_actions'])),
            applied_at: $data['applied_at'] === null ? null : (string) $data['applied_at'],
            conflicts: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['conflicts'])),
            diff: self::objectValue($data['diff']),
            errors: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['errors'])),
            id: (string) $data['id'],
            resolution: self::objectValue($data['resolution']),
            resource_type: EnvironmentTransferResourceType::from((string) $data['resource_type']),
            resource_type_label: (string) $data['resource_type_label'],
            secret_fields: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['secret_fields'])),
            selected_secret_fields: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['selected_secret_fields'])),
            source_resource_id: (string) $data['source_resource_id'],
            specification: self::objectValue($data['specification']),
            status: EnvironmentTransferItemStatus::from((string) $data['status']),
            status_color: (string) $data['status_color'],
            status_label: (string) $data['status_label'],
            target_options: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['target_options'])),
            target_resource_id: $data['target_resource_id'] === null ? null : (string) $data['target_resource_id'],
            warnings: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['warnings'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['action'] = $this->action->value;
        $data['action_label'] = $this->action_label;
        $data['allowed_actions'] = $this->allowed_actions;
        $data['applied_at'] = $this->applied_at === null ? null : $this->applied_at;
        $data['conflicts'] = $this->conflicts;
        $data['diff'] = $this->diff;
        $data['errors'] = $this->errors;
        $data['id'] = $this->id;
        $data['resolution'] = $this->resolution;
        $data['resource_type'] = $this->resource_type->value;
        $data['resource_type_label'] = $this->resource_type_label;
        $data['secret_fields'] = $this->secret_fields;
        $data['selected_secret_fields'] = $this->selected_secret_fields;
        $data['source_resource_id'] = $this->source_resource_id;
        $data['specification'] = $this->specification;
        $data['status'] = $this->status->value;
        $data['status_color'] = $this->status_color;
        $data['status_label'] = $this->status_label;
        $data['target_options'] = $this->target_options;
        $data['target_resource_id'] = $this->target_resource_id === null ? null : $this->target_resource_id;
        $data['warnings'] = $this->warnings;

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
