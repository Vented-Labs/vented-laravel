<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class FilesIndexMeta
{
    public function __construct(
        public FilesIndexMetaCapabilities $capabilities,
        public string $path,
        public NamedOption $storage,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            capabilities: FilesIndexMetaCapabilities::fromArray(self::objectValue($data['capabilities'])),
            path: (string) $data['path'],
            storage: NamedOption::fromArray(self::objectValue($data['storage'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['capabilities'] = $this->capabilities->toArray();
        $data['path'] = $this->path;
        $data['storage'] = $this->storage->toArray();

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
