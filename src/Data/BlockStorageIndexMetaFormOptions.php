<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class BlockStorageIndexMetaFormOptions
{
    /**
     * @param  list<StorageClassData>  $storage_classes
     */
    public function __construct(
        public array $storage_classes,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            storage_classes: array_map(static fn (mixed $value): StorageClassData => StorageClassData::fromArray(self::objectValue($value)), self::listValue($data['storage_classes'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['storage_classes'] = array_map(static fn (StorageClassData $value) => $value->toArray(), $this->storage_classes);

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
