<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\EnvironmentDesiredStatus;
use Vented\Enums\EnvironmentType;

final readonly class EnvironmentData
{
    public function __construct(
        public ?int $apps_count,
        public bool $can_delete,
        public bool $can_update,
        public string $created_at,
        public ?EnvironmentDesiredStatus $desired_status,
        public string $id,
        public string $location_id,
        public ?string $location_name,
        public string $name,
        public string $project_id,
        public ?int $services_count,
        public string $slug,
        public StatusData $status,
        public EnvironmentType $type,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            apps_count: $data['apps_count'] === null ? null : (int) $data['apps_count'],
            can_delete: (bool) $data['can_delete'],
            can_update: (bool) $data['can_update'],
            created_at: (string) $data['created_at'],
            desired_status: $data['desired_status'] === null ? null : EnvironmentDesiredStatus::from((string) $data['desired_status']),
            id: (string) $data['id'],
            location_id: (string) $data['location_id'],
            location_name: $data['location_name'] === null ? null : (string) $data['location_name'],
            name: (string) $data['name'],
            project_id: (string) $data['project_id'],
            services_count: $data['services_count'] === null ? null : (int) $data['services_count'],
            slug: (string) $data['slug'],
            status: StatusData::fromArray(self::objectValue($data['status'])),
            type: EnvironmentType::from((string) $data['type']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['apps_count'] = $this->apps_count === null ? null : $this->apps_count;
        $data['can_delete'] = $this->can_delete;
        $data['can_update'] = $this->can_update;
        $data['created_at'] = $this->created_at;
        $data['desired_status'] = $this->desired_status === null ? null : $this->desired_status->value;
        $data['id'] = $this->id;
        $data['location_id'] = $this->location_id;
        $data['location_name'] = $this->location_name === null ? null : $this->location_name;
        $data['name'] = $this->name;
        $data['project_id'] = $this->project_id;
        $data['services_count'] = $this->services_count === null ? null : $this->services_count;
        $data['slug'] = $this->slug;
        $data['status'] = $this->status->toArray();
        $data['type'] = $this->type->value;

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
}
