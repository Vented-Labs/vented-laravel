<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class FilesIndexMetaCapabilities
{
    public function __construct(
        public bool $can_create_directory,
        public bool $can_delete,
        public bool $can_download,
        public bool $can_upload,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            can_create_directory: (bool) $data['can_create_directory'],
            can_delete: (bool) $data['can_delete'],
            can_download: (bool) $data['can_download'],
            can_upload: (bool) $data['can_upload'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['can_create_directory'] = $this->can_create_directory;
        $data['can_delete'] = $this->can_delete;
        $data['can_download'] = $this->can_download;
        $data['can_upload'] = $this->can_upload;

        return $data;
    }
}
