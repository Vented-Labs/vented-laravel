<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class TelemetryPoint
{
    public function __construct(
        public float $limit,
        public float $percent,
        public string $sampled_at,
        public string $severity,
        public float $used,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            limit: (float) $data['limit'],
            percent: (float) $data['percent'],
            sampled_at: (string) $data['sampled_at'],
            severity: (string) $data['severity'],
            used: (float) $data['used'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['limit'] = $this->limit;
        $data['percent'] = $this->percent;
        $data['sampled_at'] = $this->sampled_at;
        $data['severity'] = $this->severity;
        $data['used'] = $this->used;

        return $data;
    }
}
