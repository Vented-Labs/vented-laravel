<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ServiceData
{
    public function __construct(
        public string $created_at,
        public ?string $icon,
        public string $id,
        public string $name,
        public string $status,
        public string $status_color,
        public string $type,
        public string $type_name,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            created_at: (string) $data['created_at'],
            icon: $data['icon'] === null ? null : (string) $data['icon'],
            id: (string) $data['id'],
            name: (string) $data['name'],
            status: (string) $data['status'],
            status_color: (string) $data['status_color'],
            type: (string) $data['type'],
            type_name: (string) $data['type_name'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['created_at'] = $this->created_at;
        $data['icon'] = $this->icon === null ? null : $this->icon;
        $data['id'] = $this->id;
        $data['name'] = $this->name;
        $data['status'] = $this->status;
        $data['status_color'] = $this->status_color;
        $data['type'] = $this->type;
        $data['type_name'] = $this->type_name;

        return $data;
    }
}
