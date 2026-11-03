<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class OverviewShowMeta
{
    /**
     * @param  list<AppData>  $apps
     * @param  list<DeployData>  $recent_deploys
     */
    public function __construct(
        public array $apps,
        public array $recent_deploys,
        public OverviewShowMetaStats $stats,
        public ?ResourceUsageData $usage,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            apps: array_map(static fn (mixed $value): AppData => AppData::fromArray(self::objectValue($value)), self::listValue($data['apps'])),
            recent_deploys: array_map(static fn (mixed $value): DeployData => DeployData::fromArray(self::objectValue($value)), self::listValue($data['recent_deploys'])),
            stats: OverviewShowMetaStats::fromArray(self::objectValue($data['stats'])),
            usage: $data['usage'] === null ? null : ResourceUsageData::fromArray(self::objectValue($data['usage'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['apps'] = array_map(static fn (AppData $value) => $value->toArray(), $this->apps);
        $data['recent_deploys'] = array_map(static fn (DeployData $value) => $value->toArray(), $this->recent_deploys);
        $data['stats'] = $this->stats->toArray();
        $data['usage'] = $this->usage === null ? null : $this->usage->toArray();

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
