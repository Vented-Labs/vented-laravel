<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class StorageClassData
{
    public function __construct(
        public ?string $description,
        public string $id,
        public string $key,
        public int $max_size_gb,
        public int $min_size_gb,
        public string $name,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            description: $data['description'] === null ? null : (string) $data['description'],
            id: (string) $data['id'],
            key: (string) $data['key'],
            max_size_gb: (int) $data['max_size_gb'],
            min_size_gb: (int) $data['min_size_gb'],
            name: (string) $data['name'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['description'] = $this->description === null ? null : $this->description;
        $data['id'] = $this->id;
        $data['key'] = $this->key;
        $data['max_size_gb'] = $this->max_size_gb;
        $data['min_size_gb'] = $this->min_size_gb;
        $data['name'] = $this->name;

        return $data;
    }
}
