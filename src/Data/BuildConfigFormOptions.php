<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class BuildConfigFormOptions
{
    /**
     * @param  list<DeployTypeOption>  $deploy_types
     * @param  list<GitConnectionOption>  $git_connections
     * @param  list<FormOption>  $groups
     * @param  list<FormOption>  $integrations
     * @param  list<BuildPresetOption>  $presets
     * @param  list<BuildStorageOption>  $storages
     */
    public function __construct(
        public array $deploy_types,
        public array $git_connections,
        public array $groups,
        public array $integrations,
        public array $presets,
        public array $storages,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            deploy_types: array_map(static fn (mixed $value): DeployTypeOption => DeployTypeOption::fromArray(self::objectValue($value)), self::listValue($data['deploy_types'])),
            git_connections: array_map(static fn (mixed $value): GitConnectionOption => GitConnectionOption::fromArray(self::objectValue($value)), self::listValue($data['git_connections'])),
            groups: array_map(static fn (mixed $value): FormOption => FormOption::fromArray(self::objectValue($value)), self::listValue($data['groups'])),
            integrations: array_map(static fn (mixed $value): FormOption => FormOption::fromArray(self::objectValue($value)), self::listValue($data['integrations'])),
            presets: array_map(static fn (mixed $value): BuildPresetOption => BuildPresetOption::fromArray(self::objectValue($value)), self::listValue($data['presets'])),
            storages: array_map(static fn (mixed $value): BuildStorageOption => BuildStorageOption::fromArray(self::objectValue($value)), self::listValue($data['storages'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['deploy_types'] = array_map(static fn (DeployTypeOption $value) => $value->toArray(), $this->deploy_types);
        $data['git_connections'] = array_map(static fn (GitConnectionOption $value) => $value->toArray(), $this->git_connections);
        $data['groups'] = array_map(static fn (FormOption $value) => $value->toArray(), $this->groups);
        $data['integrations'] = array_map(static fn (FormOption $value) => $value->toArray(), $this->integrations);
        $data['presets'] = array_map(static fn (BuildPresetOption $value) => $value->toArray(), $this->presets);
        $data['storages'] = array_map(static fn (BuildStorageOption $value) => $value->toArray(), $this->storages);

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
