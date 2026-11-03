<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ServiceShowMeta
{
    public function __construct(
        public bool $can_update,
        public string $location_id,
        public ?string $location_name,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            can_update: (bool) $data['can_update'],
            location_id: (string) $data['location_id'],
            location_name: $data['location_name'] === null ? null : (string) $data['location_name'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['can_update'] = $this->can_update;
        $data['location_id'] = $this->location_id;
        $data['location_name'] = $this->location_name === null ? null : $this->location_name;

        return $data;
    }
}
