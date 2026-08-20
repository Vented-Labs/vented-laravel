<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\EnvironmentDesiredStatus;
use Vented\Enums\EnvironmentStatus;
use Vented\Enums\EnvironmentType;

final readonly class EnvironmentData
{
    public function __construct(
        public bool $can_delete,
        public bool $can_update,
        public string $created_at,
        public ?EnvironmentDesiredStatus $desired_status,
        public string $id,
        public string $location_id,
        public ?string $location_name,
        public string $name,
        public string $project_id,
        public string $slug,
        public EnvironmentStatus $status,
        public string $status_color,
        public string $status_label,
        public EnvironmentType $type,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            can_delete: (bool) $data['can_delete'],
            can_update: (bool) $data['can_update'],
            created_at: (string) $data['created_at'],
            desired_status: $data['desired_status'] === null ? null : EnvironmentDesiredStatus::from((string) $data['desired_status']),
            id: (string) $data['id'],
            location_id: (string) $data['location_id'],
            location_name: $data['location_name'] === null ? null : (string) $data['location_name'],
            name: (string) $data['name'],
            project_id: (string) $data['project_id'],
            slug: (string) $data['slug'],
            status: EnvironmentStatus::from((string) $data['status']),
            status_color: (string) $data['status_color'],
            status_label: (string) $data['status_label'],
            type: EnvironmentType::from((string) $data['type']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['can_delete'] = $this->can_delete;
        $data['can_update'] = $this->can_update;
        $data['created_at'] = $this->created_at;
        $data['desired_status'] = $this->desired_status === null ? null : $this->desired_status->value;
        $data['id'] = $this->id;
        $data['location_id'] = $this->location_id;
        $data['location_name'] = $this->location_name === null ? null : $this->location_name;
        $data['name'] = $this->name;
        $data['project_id'] = $this->project_id;
        $data['slug'] = $this->slug;
        $data['status'] = $this->status->value;
        $data['status_color'] = $this->status_color;
        $data['status_label'] = $this->status_label;
        $data['type'] = $this->type->value;

        return $data;
    }
}
