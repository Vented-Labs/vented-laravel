<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class TelemetryMetric
{
    /**
     * @param  list<TelemetryPoint>  $history
     */
    public function __construct(
        public ?int $cores,
        public array $history,
        public ?float $limit,
        public ?float $load_average,
        public ?float $percent,
        public string $severity,
        public ?float $used,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            cores: $data['cores'] === null ? null : (int) $data['cores'],
            history: array_map(static fn (mixed $value): TelemetryPoint => TelemetryPoint::fromArray(self::objectValue($value)), self::listValue($data['history'])),
            limit: $data['limit'] === null ? null : (float) $data['limit'],
            load_average: $data['load_average'] === null ? null : (float) $data['load_average'],
            percent: $data['percent'] === null ? null : (float) $data['percent'],
            severity: (string) $data['severity'],
            used: $data['used'] === null ? null : (float) $data['used'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['cores'] = $this->cores === null ? null : $this->cores;
        $data['history'] = array_map(static fn (TelemetryPoint $value) => $value->toArray(), $this->history);
        $data['limit'] = $this->limit === null ? null : $this->limit;
        $data['load_average'] = $this->load_average === null ? null : $this->load_average;
        $data['percent'] = $this->percent === null ? null : $this->percent;
        $data['severity'] = $this->severity;
        $data['used'] = $this->used === null ? null : $this->used;

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
