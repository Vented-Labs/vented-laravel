<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\FileKind;

final readonly class FileResourceData
{
    public function __construct(
        public ?string $etag,
        public FileKind $kind,
        public ?string $last_modified,
        public ?string $mime_type,
        public ?string $mode,
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
            etag: $data['etag'] === null ? null : (string) $data['etag'],
            kind: FileKind::from((string) $data['kind']),
            last_modified: $data['last_modified'] === null ? null : (string) $data['last_modified'],
            mime_type: $data['mime_type'] === null ? null : (string) $data['mime_type'],
            mode: $data['mode'] === null ? null : (string) $data['mode'],
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
        $data['etag'] = $this->etag === null ? null : $this->etag;
        $data['kind'] = $this->kind->value;
        $data['last_modified'] = $this->last_modified === null ? null : $this->last_modified;
        $data['mime_type'] = $this->mime_type === null ? null : $this->mime_type;
        $data['mode'] = $this->mode === null ? null : $this->mode;
        $data['name'] = $this->name;
        $data['path'] = $this->path;
        $data['size'] = $this->size === null ? null : $this->size;

        return $data;
    }
}
