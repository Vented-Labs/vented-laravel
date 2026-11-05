<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class OrganizationShowMeta
{
    /**
     * @param  list<ProjectData>  $projects
     * @param  array<string, mixed>  $settings
     * @param  list<SettingsGroup>  $settings_groups
     */
    public function __construct(
        public bool $can_create_project,
        public bool $can_manage_members,
        public bool $can_update,
        public array $projects,
        public array $settings,
        public array $settings_groups,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            can_create_project: (bool) $data['can_create_project'],
            can_manage_members: (bool) $data['can_manage_members'],
            can_update: (bool) $data['can_update'],
            projects: array_map(static fn (mixed $value): ProjectData => ProjectData::fromArray(self::objectValue($value)), self::listValue($data['projects'])),
            settings: self::objectValue($data['settings']),
            settings_groups: array_map(static fn (mixed $value): SettingsGroup => SettingsGroup::fromArray(self::objectValue($value)), self::listValue($data['settings_groups'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['can_create_project'] = $this->can_create_project;
        $data['can_manage_members'] = $this->can_manage_members;
        $data['can_update'] = $this->can_update;
        $data['projects'] = array_map(static fn (ProjectData $value) => $value->toArray(), $this->projects);
        $data['settings'] = $this->settings;
        $data['settings_groups'] = array_map(static fn (SettingsGroup $value) => $value->toArray(), $this->settings_groups);

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
