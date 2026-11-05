<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class OrganizationShowMeta
{
    /**
     * @param  list<ProjectData>  $projects
     * @param  array<string, mixed>  $settings
     * @param  list<SettingsGroup>  $settings_groups
     * @param  list<TransferableMember>  $transferable_members
     */
    public function __construct(
        public bool $can_accept_transfer,
        public bool $can_cancel_transfer,
        public bool $can_create_project,
        public bool $can_delete,
        public bool $can_leave,
        public bool $can_manage_members,
        public bool $can_transfer_ownership,
        public bool $can_update,
        public ?PendingTransferData $pending_transfer,
        public array $projects,
        public array $settings,
        public array $settings_groups,
        public array $transferable_members,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            can_accept_transfer: (bool) $data['can_accept_transfer'],
            can_cancel_transfer: (bool) $data['can_cancel_transfer'],
            can_create_project: (bool) $data['can_create_project'],
            can_delete: (bool) $data['can_delete'],
            can_leave: (bool) $data['can_leave'],
            can_manage_members: (bool) $data['can_manage_members'],
            can_transfer_ownership: (bool) $data['can_transfer_ownership'],
            can_update: (bool) $data['can_update'],
            pending_transfer: $data['pending_transfer'] === null ? null : PendingTransferData::fromArray(self::objectValue($data['pending_transfer'])),
            projects: array_map(static fn (mixed $value): ProjectData => ProjectData::fromArray(self::objectValue($value)), self::listValue($data['projects'])),
            settings: self::objectValue($data['settings']),
            settings_groups: array_map(static fn (mixed $value): SettingsGroup => SettingsGroup::fromArray(self::objectValue($value)), self::listValue($data['settings_groups'])),
            transferable_members: array_map(static fn (mixed $value): TransferableMember => TransferableMember::fromArray(self::objectValue($value)), self::listValue($data['transferable_members'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['can_accept_transfer'] = $this->can_accept_transfer;
        $data['can_cancel_transfer'] = $this->can_cancel_transfer;
        $data['can_create_project'] = $this->can_create_project;
        $data['can_delete'] = $this->can_delete;
        $data['can_leave'] = $this->can_leave;
        $data['can_manage_members'] = $this->can_manage_members;
        $data['can_transfer_ownership'] = $this->can_transfer_ownership;
        $data['can_update'] = $this->can_update;
        $data['pending_transfer'] = $this->pending_transfer === null ? null : $this->pending_transfer->toArray();
        $data['projects'] = array_map(static fn (ProjectData $value) => $value->toArray(), $this->projects);
        $data['settings'] = $this->settings;
        $data['settings_groups'] = array_map(static fn (SettingsGroup $value) => $value->toArray(), $this->settings_groups);
        $data['transferable_members'] = array_map(static fn (TransferableMember $value) => $value->toArray(), $this->transferable_members);

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
