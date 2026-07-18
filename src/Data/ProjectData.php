<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ProjectData
{
    public function __construct(
        public string $created_at,
        public ?string $desired_status,
        public string $id,
        public bool $is_new,
        public bool $is_synced,
        public string $location_id,
        public string $name,
        public string $status,
        public ?string $synced_at,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            created_at: (string) $data['created_at'],
            desired_status: $data['desired_status'] === null ? null : (string) $data['desired_status'],
            id: (string) $data['id'],
            is_new: (bool) $data['is_new'],
            is_synced: (bool) $data['is_synced'],
            location_id: (string) $data['location_id'],
            name: (string) $data['name'],
            status: (string) $data['status'],
            synced_at: $data['synced_at'] === null ? null : (string) $data['synced_at'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['created_at'] = $this->created_at;
        $data['desired_status'] = $this->desired_status === null ? null : $this->desired_status;
        $data['id'] = $this->id;
        $data['is_new'] = $this->is_new;
        $data['is_synced'] = $this->is_synced;
        $data['location_id'] = $this->location_id;
        $data['name'] = $this->name;
        $data['status'] = $this->status;
        $data['synced_at'] = $this->synced_at === null ? null : $this->synced_at;

        return $data;
    }
}
