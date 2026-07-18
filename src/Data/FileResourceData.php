<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class FileResourceData
{
    public function __construct(
        public string $kind,
        public ?string $last_modified,
        public string $name,
        public string $path,
        public ?int $size,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            kind: (string) $data['kind'],
            last_modified: $data['last_modified'] === null ? null : (string) $data['last_modified'],
            name: (string) $data['name'],
            path: (string) $data['path'],
            size: $data['size'] === null ? null : (int) $data['size'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['kind'] = $this->kind;
        $data['last_modified'] = $this->last_modified === null ? null : $this->last_modified;
        $data['name'] = $this->name;
        $data['path'] = $this->path;
        $data['size'] = $this->size === null ? null : $this->size;

        return $data;
    }
}
