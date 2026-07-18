<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class Monitoring
{
    /**
     * @param  list<float>  $uptime_history
     */
    public function __construct(
        public string $cpu_usage,
        public string $memory_limit,
        public ?float $memory_percent,
        public string $memory_usage,
        public string $started_at,
        public string $status,
        public string $status_color,
        public string $uptime,
        public array $uptime_history,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            cpu_usage: (string) $data['cpu_usage'],
            memory_limit: (string) $data['memory_limit'],
            memory_percent: $data['memory_percent'] === null ? null : (float) $data['memory_percent'],
            memory_usage: (string) $data['memory_usage'],
            started_at: (string) $data['started_at'],
            status: (string) $data['status'],
            status_color: (string) $data['status_color'],
            uptime: (string) $data['uptime'],
            uptime_history: array_map(static fn (mixed $value): float => (float) $value, self::listValue($data['uptime_history'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['cpu_usage'] = $this->cpu_usage;
        $data['memory_limit'] = $this->memory_limit;
        $data['memory_percent'] = $this->memory_percent === null ? null : $this->memory_percent;
        $data['memory_usage'] = $this->memory_usage;
        $data['started_at'] = $this->started_at;
        $data['status'] = $this->status;
        $data['status_color'] = $this->status_color;
        $data['uptime'] = $this->uptime;
        $data['uptime_history'] = $this->uptime_history;

        return $data;
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
