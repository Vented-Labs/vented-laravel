<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class StoreProjectData
{
    public function __construct(
        public string $location_id,
        public string $name,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            location_id: (string) $data['location_id'],
            name: (string) $data['name'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['location_id'] = $this->location_id;
        $data['name'] = $this->name;

        return $data;
    }
}
