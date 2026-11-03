<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class TelemetryNetwork
{
    /**
     * @param  list<TelemetryNetworkPoint>  $history
     */
    public function __construct(
        public array $history,
        public ?float $rx_bytes_per_second,
        public ?float $tx_bytes_per_second,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            history: array_map(static fn (mixed $value): TelemetryNetworkPoint => TelemetryNetworkPoint::fromArray(self::objectValue($value)), self::listValue($data['history'])),
            rx_bytes_per_second: $data['rx_bytes_per_second'] === null ? null : (float) $data['rx_bytes_per_second'],
            tx_bytes_per_second: $data['tx_bytes_per_second'] === null ? null : (float) $data['tx_bytes_per_second'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['history'] = array_map(static fn (TelemetryNetworkPoint $value) => $value->toArray(), $this->history);
        $data['rx_bytes_per_second'] = $this->rx_bytes_per_second === null ? null : $this->rx_bytes_per_second;
        $data['tx_bytes_per_second'] = $this->tx_bytes_per_second === null ? null : $this->tx_bytes_per_second;

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
