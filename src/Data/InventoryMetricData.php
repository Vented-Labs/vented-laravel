<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\StatusTone;

final readonly class InventoryMetricData
{
    /**
     * @param  list<TelemetryPoint>  $history
     */
    public function __construct(
        public bool $applicable,
        public bool $available,
        public array $history,
        public string $label,
        public ?float $limit,
        public ?float $percent,
        public ?string $sampled_at,
        public string $scope,
        public string $source,
        public StatusTone $tone,
        public ?string $unavailable_reason,
        public string $unit,
        public ?float $used,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            applicable: (bool) $data['applicable'],
            available: (bool) $data['available'],
            history: array_map(static fn (mixed $value): TelemetryPoint => TelemetryPoint::fromArray(self::objectValue($value)), self::listValue($data['history'])),
            label: (string) $data['label'],
            limit: $data['limit'] === null ? null : (float) $data['limit'],
            percent: $data['percent'] === null ? null : (float) $data['percent'],
            sampled_at: $data['sampled_at'] === null ? null : (string) $data['sampled_at'],
            scope: (string) $data['scope'],
            source: (string) $data['source'],
            tone: StatusTone::from((string) $data['tone']),
            unavailable_reason: $data['unavailable_reason'] === null ? null : (string) $data['unavailable_reason'],
            unit: (string) $data['unit'],
            used: $data['used'] === null ? null : (float) $data['used'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['applicable'] = $this->applicable;
        $data['available'] = $this->available;
        $data['history'] = array_map(static fn (TelemetryPoint $value) => $value->toArray(), $this->history);
        $data['label'] = $this->label;
        $data['limit'] = $this->limit === null ? null : $this->limit;
        $data['percent'] = $this->percent === null ? null : $this->percent;
        $data['sampled_at'] = $this->sampled_at === null ? null : $this->sampled_at;
        $data['scope'] = $this->scope;
        $data['source'] = $this->source;
        $data['tone'] = $this->tone->value;
        $data['unavailable_reason'] = $this->unavailable_reason === null ? null : $this->unavailable_reason;
        $data['unit'] = $this->unit;
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
