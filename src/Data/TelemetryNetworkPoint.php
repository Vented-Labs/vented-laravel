<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class TelemetryNetworkPoint
{
    public function __construct(
        public float $rx_bytes_per_second,
        public string $sampled_at,
        public float $tx_bytes_per_second,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            rx_bytes_per_second: (float) $data['rx_bytes_per_second'],
            sampled_at: (string) $data['sampled_at'],
            tx_bytes_per_second: (float) $data['tx_bytes_per_second'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['rx_bytes_per_second'] = $this->rx_bytes_per_second;
        $data['sampled_at'] = $this->sampled_at;
        $data['tx_bytes_per_second'] = $this->tx_bytes_per_second;

        return $data;
    }
}
