<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class StackResourceOptionData
{
    public function __construct(
        public ?string $category,
        public string $identifier,
        public string $kind,
        public string $name,
        public string $resource_id,
        public ?int $size_mb,
        public ?string $version,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            category: $data['category'] === null ? null : (string) $data['category'],
            identifier: (string) $data['identifier'],
            kind: (string) $data['kind'],
            name: (string) $data['name'],
            resource_id: (string) $data['resource_id'],
            size_mb: $data['size_mb'] === null ? null : (int) $data['size_mb'],
            version: $data['version'] === null ? null : (string) $data['version'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['category'] = $this->category === null ? null : $this->category;
        $data['identifier'] = $this->identifier;
        $data['kind'] = $this->kind;
        $data['name'] = $this->name;
        $data['resource_id'] = $this->resource_id;
        $data['size_mb'] = $this->size_mb === null ? null : $this->size_mb;
        $data['version'] = $this->version === null ? null : $this->version;

        return $data;
    }
}
