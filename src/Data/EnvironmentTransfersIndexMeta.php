<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class EnvironmentTransfersIndexMeta
{
    /**
     * @param  list<EnvironmentTransferPresetData>  $presets
     * @param  list<EnvironmentTransferResourceGroupData>  $resource_groups
     * @param  list<EnvironmentRef>  $source_environments
     */
    public function __construct(
        public bool $can_copy_secrets,
        public bool $can_create_transfer,
        public bool $can_manage_presets,
        public array $presets,
        public array $resource_groups,
        public ?string $selected_source_environment_id,
        public array $source_environments,
        public EnvironmentRef $target_environment,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            can_copy_secrets: (bool) $data['can_copy_secrets'],
            can_create_transfer: (bool) $data['can_create_transfer'],
            can_manage_presets: (bool) $data['can_manage_presets'],
            presets: array_map(static fn (mixed $value): EnvironmentTransferPresetData => EnvironmentTransferPresetData::fromArray(self::objectValue($value)), self::listValue($data['presets'])),
            resource_groups: array_map(static fn (mixed $value): EnvironmentTransferResourceGroupData => EnvironmentTransferResourceGroupData::fromArray(self::objectValue($value)), self::listValue($data['resource_groups'])),
            selected_source_environment_id: $data['selected_source_environment_id'] === null ? null : (string) $data['selected_source_environment_id'],
            source_environments: array_map(static fn (mixed $value): EnvironmentRef => EnvironmentRef::fromArray(self::objectValue($value)), self::listValue($data['source_environments'])),
            target_environment: EnvironmentRef::fromArray(self::objectValue($data['target_environment'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['can_copy_secrets'] = $this->can_copy_secrets;
        $data['can_create_transfer'] = $this->can_create_transfer;
        $data['can_manage_presets'] = $this->can_manage_presets;
        $data['presets'] = array_map(static fn (EnvironmentTransferPresetData $value) => $value->toArray(), $this->presets);
        $data['resource_groups'] = array_map(static fn (EnvironmentTransferResourceGroupData $value) => $value->toArray(), $this->resource_groups);
        $data['selected_source_environment_id'] = $this->selected_source_environment_id === null ? null : $this->selected_source_environment_id;
        $data['source_environments'] = array_map(static fn (EnvironmentRef $value) => $value->toArray(), $this->source_environments);
        $data['target_environment'] = $this->target_environment->toArray();

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
