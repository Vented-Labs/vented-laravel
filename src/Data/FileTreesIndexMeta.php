<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class FileTreesIndexMeta
{
    /**
     * @param  list<string>  $partial
     */
    public function __construct(
        public FileCapabilitiesData $capabilities,
        public int $depth,
        public int $hidden,
        public array $partial,
        public string $path,
        public NamedOption $storage,
        public bool $truncated,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            capabilities: FileCapabilitiesData::fromArray(self::objectValue($data['capabilities'])),
            depth: (int) $data['depth'],
            hidden: (int) $data['hidden'],
            partial: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['partial'])),
            path: (string) $data['path'],
            storage: NamedOption::fromArray(self::objectValue($data['storage'])),
            truncated: (bool) $data['truncated'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['capabilities'] = $this->capabilities->toArray();
        $data['depth'] = $this->depth;
        $data['hidden'] = $this->hidden;
        $data['partial'] = $this->partial;
        $data['path'] = $this->path;
        $data['storage'] = $this->storage->toArray();
        $data['truncated'] = $this->truncated;

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
