<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\OptionalValue;

final readonly class StoreFileData
{
    /**
     * @param  list<array<string, mixed>>|OptionalValue  $uploads
     */
    public function __construct(
        public string $kind,
        public ?string $path,
        public string|null|OptionalValue $name = OptionalValue::Missing,
        public array|OptionalValue $uploads = OptionalValue::Missing,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            kind: (string) $data['kind'],
            path: $data['path'] === null ? null : (string) $data['path'],
            name: array_key_exists('name', $data) ? $data['name'] === null ? null : (string) $data['name'] : OptionalValue::Missing,
            uploads: array_key_exists('uploads', $data) ? array_map(static fn (mixed $value): array => self::objectValue($value), self::listValue($data['uploads'])) : OptionalValue::Missing,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['kind'] = $this->kind;
        $data['path'] = $this->path === null ? null : $this->path;
        if ($this->name !== OptionalValue::Missing) {
            $data['name'] = $this->name === null ? null : $this->name;
        }
        if ($this->uploads !== OptionalValue::Missing) {
            $data['uploads'] = $this->uploads;
        }

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
