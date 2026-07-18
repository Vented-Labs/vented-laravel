<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class StorageRef
{
    public function __construct(
        public string $id,
        public string $name,
        public ?string $size,
        public ?string $status,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: (string) $data['id'],
            name: (string) $data['name'],
            size: $data['size'] === null ? null : (string) $data['size'],
            status: $data['status'] === null ? null : (string) $data['status'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['id'] = $this->id;
        $data['name'] = $this->name;
        $data['size'] = $this->size === null ? null : $this->size;
        $data['status'] = $this->status === null ? null : $this->status;

        return $data;
    }
}
