<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class FileContentData
{
    public function __construct(
        public string $content,
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
        $data['mime_type'] = $this->mime_type === null ? null : $this->mime_type;
        $data['path'] = $this->path;
        $data['size'] = $this->size;

        return $data;
    }
}
