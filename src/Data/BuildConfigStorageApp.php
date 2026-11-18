<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class BuildConfigStorageApp
{
    public function __construct(
        public string $id,
        public string $mount_point,
        public string $name,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: (string) $data['id'],
            mount_point: (string) $data['mount_point'],
            name: (string) $data['name'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['id'] = $this->id;
        $data['mount_point'] = $this->mount_point;
        $data['name'] = $this->name;

        return $data;
    }
}
