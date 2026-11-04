<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class FileUploadData
{
    /**
     * @param  list<int>  $parts_received
     */
    public function __construct(
        public string $expires_at,
        public ?FileResourceData $file,
        public string $id,
        public ?string $mime_type,
        public int $part_size,
        public array $parts_received,
        public int $parts_total,
        public string $path,
        public int $size,
        public StatusData $status,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            expires_at: (string) $data['expires_at'],
            file: $data['file'] === null ? null : FileResourceData::fromArray(self::objectValue($data['file'])),
            id: (string) $data['id'],
            mime_type: $data['mime_type'] === null ? null : (string) $data['mime_type'],
            part_size: (int) $data['part_size'],
            parts_received: array_map(static fn (mixed $value): int => (int) $value, self::listValue($data['parts_received'])),
            parts_total: (int) $data['parts_total'],
            path: (string) $data['path'],
            size: (int) $data['size'],
            status: StatusData::fromArray(self::objectValue($data['status'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['expires_at'] = $this->expires_at;
        $data['file'] = $this->file === null ? null : $this->file->toArray();
        $data['id'] = $this->id;
        $data['mime_type'] = $this->mime_type === null ? null : $this->mime_type;
        $data['part_size'] = $this->part_size;
        $data['parts_received'] = $this->parts_received;
        $data['parts_total'] = $this->parts_total;
        $data['path'] = $this->path;
        $data['size'] = $this->size;
        $data['status'] = $this->status->toArray();

        return $data;
    }

    /**
     * @return array<string, mixed>
     */
    private static function objectValue(mixed $value): array
    {
        if (! is_array($value)) {
            throw new \InvalidArgumentException('Expected an object value.');
        }

        /** @var array<string, mixed> $value */
        return $value;
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
