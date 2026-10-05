<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class BlockStorageShowMeta
{
    /**
     * @param  list<NamedOption>  $attached_apps
     */
    public function __construct(
        public array $attached_apps,
        public BlockStorageStatistics $statistics,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            attached_apps: array_map(static fn (mixed $value): NamedOption => NamedOption::fromArray(self::objectValue($value)), self::listValue($data['attached_apps'])),
            statistics: BlockStorageStatistics::fromArray(self::objectValue($data['statistics'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['attached_apps'] = array_map(static fn (NamedOption $value) => $value->toArray(), $this->attached_apps);
        $data['statistics'] = $this->statistics->toArray();

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
