<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class FileContentData
{
    public function __construct(
        public string $content,
        public string $encoding,
        public ?string $etag,
        public ?string $last_modified,
        public ?string $mime_type,
        public string $path,
        public int $size,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            content: (string) $data['content'],
            encoding: (string) $data['encoding'],
            etag: $data['etag'] === null ? null : (string) $data['etag'],
            last_modified: $data['last_modified'] === null ? null : (string) $data['last_modified'],
            mime_type: $data['mime_type'] === null ? null : (string) $data['mime_type'],
            path: (string) $data['path'],
            size: (int) $data['size'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['content'] = $this->content;
        $data['encoding'] = $this->encoding;
        $data['etag'] = $this->etag === null ? null : $this->etag;
        $data['last_modified'] = $this->last_modified === null ? null : $this->last_modified;
        $data['mime_type'] = $this->mime_type === null ? null : $this->mime_type;
        $data['path'] = $this->path;
        $data['size'] = $this->size;

        return $data;
    }
}
