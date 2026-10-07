<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class OverviewShowMeta
{
    /**
     * @param  list<AppData>  $apps
     * @param  list<DeployData>  $recent_deploys
     * @param  list<string>|null  $requests
     * @param  list<string>|null  $uptime
     */
    public function __construct(
        public array $apps,
        public array $recent_deploys,
        public ?array $requests,
        public OverviewShowMetaStats $stats,
        public ?array $uptime,
        public ?PlanSampleUsageData $usage,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            apps: array_map(static fn (mixed $value): AppData => AppData::fromArray(self::objectValue($value)), self::listValue($data['apps'])),
            recent_deploys: array_map(static fn (mixed $value): DeployData => DeployData::fromArray(self::objectValue($value)), self::listValue($data['recent_deploys'])),
            requests: $data['requests'] === null ? null : array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['requests'])),
            stats: OverviewShowMetaStats::fromArray(self::objectValue($data['stats'])),
            uptime: $data['uptime'] === null ? null : array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['uptime'])),
            usage: $data['usage'] === null ? null : PlanSampleUsageData::fromArray(self::objectValue($data['usage'])),
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
        $data['requests'] = $this->requests === null ? null : $this->requests;
        $data['stats'] = $this->stats->toArray();
        $data['uptime'] = $this->uptime === null ? null : $this->uptime;
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
