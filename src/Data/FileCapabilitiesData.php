<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class FileCapabilitiesData
{
    /**
     * @param  list<string>  $metadata
     */
    public function __construct(
        public bool $atomic_write,
        public bool $available,
        public bool $can_copy,
        public bool $can_create_directory,
        public bool $can_delete,
        public bool $can_download,
        public bool $can_list_tree,
        public bool $can_move,
        public bool $can_read,
        public bool $can_upload,
        public bool $can_write,
        public bool $case_sensitive,
        public string $directories,
        public int $max_read_bytes,
        public int $max_upload_bytes,
        public int $max_write_bytes,
        public array $metadata,
        public int $page_size,
        public int $part_size_bytes,
        public ?string $read_only_reason,
        public int $tree_depth,
        public int $tree_limit,
        public ?string $unavailable_reason,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            atomic_write: (bool) $data['atomic_write'],
            available: (bool) $data['available'],
            can_copy: (bool) $data['can_copy'],
            can_create_directory: (bool) $data['can_create_directory'],
            can_delete: (bool) $data['can_delete'],
            can_download: (bool) $data['can_download'],
            can_list_tree: (bool) $data['can_list_tree'],
            can_move: (bool) $data['can_move'],
            can_read: (bool) $data['can_read'],
            can_upload: (bool) $data['can_upload'],
            can_write: (bool) $data['can_write'],
            case_sensitive: (bool) $data['case_sensitive'],
            directories: (string) $data['directories'],
            max_read_bytes: (int) $data['max_read_bytes'],
            max_upload_bytes: (int) $data['max_upload_bytes'],
            max_write_bytes: (int) $data['max_write_bytes'],
            metadata: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['metadata'])),
            page_size: (int) $data['page_size'],
            part_size_bytes: (int) $data['part_size_bytes'],
            read_only_reason: $data['read_only_reason'] === null ? null : (string) $data['read_only_reason'],
            tree_depth: (int) $data['tree_depth'],
            tree_limit: (int) $data['tree_limit'],
            unavailable_reason: $data['unavailable_reason'] === null ? null : (string) $data['unavailable_reason'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['atomic_write'] = $this->atomic_write;
        $data['available'] = $this->available;
        $data['can_copy'] = $this->can_copy;
        $data['can_create_directory'] = $this->can_create_directory;
        $data['can_delete'] = $this->can_delete;
        $data['can_download'] = $this->can_download;
        $data['can_list_tree'] = $this->can_list_tree;
        $data['can_move'] = $this->can_move;
        $data['can_read'] = $this->can_read;
        $data['can_upload'] = $this->can_upload;
        $data['can_write'] = $this->can_write;
        $data['case_sensitive'] = $this->case_sensitive;
        $data['directories'] = $this->directories;
        $data['max_read_bytes'] = $this->max_read_bytes;
        $data['max_upload_bytes'] = $this->max_upload_bytes;
        $data['max_write_bytes'] = $this->max_write_bytes;
        $data['metadata'] = $this->metadata;
        $data['page_size'] = $this->page_size;
        $data['part_size_bytes'] = $this->part_size_bytes;
        $data['read_only_reason'] = $this->read_only_reason === null ? null : $this->read_only_reason;
        $data['tree_depth'] = $this->tree_depth;
        $data['tree_limit'] = $this->tree_limit;
        $data['unavailable_reason'] = $this->unavailable_reason === null ? null : $this->unavailable_reason;

        return $data;
    }

    /**
     * @return list<mixed>
     */
    private static function listValue(mixed $value): array
    {
        if (! is_array($value)) {
            throw new \InvalidArgumentException('Expected an array value.');
        }

        return array_values($value);
    }
}
