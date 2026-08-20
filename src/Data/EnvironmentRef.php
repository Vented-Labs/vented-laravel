<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\EnvironmentType;

final readonly class EnvironmentRef
{
    public function __construct(
        public ?string $desired_status,
        public string $id,
        public string $location_id,
        public string $name,
        public string $slug,
        public string $status,
        public EnvironmentType $type,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            desired_status: $data['desired_status'] === null ? null : (string) $data['desired_status'],
            id: (string) $data['id'],
            location_id: (string) $data['location_id'],
            name: (string) $data['name'],
            slug: (string) $data['slug'],
            status: (string) $data['status'],
            type: EnvironmentType::from((string) $data['type']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['desired_status'] = $this->desired_status === null ? null : $this->desired_status;
        $data['id'] = $this->id;
        $data['location_id'] = $this->location_id;
        $data['name'] = $this->name;
        $data['slug'] = $this->slug;
        $data['status'] = $this->status;
        $data['type'] = $this->type->value;

        return $data;
    }
}
