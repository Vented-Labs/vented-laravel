<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class BlockStorageBackupsMetaStorage
{
    public function __construct(
        public string $name,
        public ?string $size,
        public StorageClassRef $storage_class,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            name: (string) $data['name'],
            size: $data['size'] === null ? null : (string) $data['size'],
            storage_class: StorageClassRef::fromArray(self::objectValue($data['storage_class'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['name'] = $this->name;
        $data['size'] = $this->size === null ? null : $this->size;
        $data['storage_class'] = $this->storage_class->toArray();

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
}
