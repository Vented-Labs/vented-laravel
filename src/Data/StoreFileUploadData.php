<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\OptionalValue;

final readonly class StoreFileUploadData
{
    public function __construct(
        public string $path,
        public int $size,
        public string|null|OptionalValue $mime_type = OptionalValue::Missing,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            path: (string) $data['path'],
            size: (int) $data['size'],
            mime_type: array_key_exists('mime_type', $data) ? $data['mime_type'] === null ? null : (string) $data['mime_type'] : OptionalValue::Missing,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['path'] = $this->path;
        $data['size'] = $this->size;
        if ($this->mime_type !== OptionalValue::Missing) {
            $data['mime_type'] = $this->mime_type === null ? null : $this->mime_type;
        }

        return $data;
    }
}
