<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class BlockStorageShowMeta
{
    public function __construct(
        public BlockStorageStatistics $statistics,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            statistics: BlockStorageStatistics::fromArray(self::objectValue($data['statistics'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
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
}
