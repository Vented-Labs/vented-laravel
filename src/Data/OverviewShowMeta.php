<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class OverviewShowMeta
{
    public function __construct(
        public OverviewShowMetaStats $stats,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            stats: OverviewShowMetaStats::fromArray(self::objectValue($data['stats'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['stats'] = $this->stats->toArray();

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
