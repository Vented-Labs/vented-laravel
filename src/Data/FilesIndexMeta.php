<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class FilesIndexMeta
{
    public function __construct(
        public bool $can_manage,
        public FileCapabilitiesData $capabilities,
        public int $hidden,
        public ?string $next_cursor,
        public string $path,
        public NamedOption $storage,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            can_manage: (bool) $data['can_manage'],
            capabilities: FileCapabilitiesData::fromArray(self::objectValue($data['capabilities'])),
            hidden: (int) $data['hidden'],
            next_cursor: $data['next_cursor'] === null ? null : (string) $data['next_cursor'],
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
        $data['can_manage'] = $this->can_manage;
        $data['capabilities'] = $this->capabilities->toArray();
        $data['hidden'] = $this->hidden;
        $data['next_cursor'] = $this->next_cursor === null ? null : $this->next_cursor;
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
