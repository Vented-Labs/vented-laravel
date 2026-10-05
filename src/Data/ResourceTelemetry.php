<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ResourceTelemetry
{
    public function __construct(
        public TelemetryMetric $cpu,
        public TelemetryMetric $disk,
        public TelemetryMetric $memory,
        public string $sampled_at,
        public string $source,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            cpu: TelemetryMetric::fromArray(self::objectValue($data['cpu'])),
            disk: TelemetryMetric::fromArray(self::objectValue($data['disk'])),
            memory: TelemetryMetric::fromArray(self::objectValue($data['memory'])),
            sampled_at: (string) $data['sampled_at'],
            source: (string) $data['source'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['cpu'] = $this->cpu->toArray();
        $data['disk'] = $this->disk->toArray();
        $data['memory'] = $this->memory->toArray();
        $data['sampled_at'] = $this->sampled_at;
        $data['source'] = $this->source;

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
