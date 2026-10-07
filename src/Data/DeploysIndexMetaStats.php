<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class DeploysIndexMetaStats
{
    /**
     * @param  list<int>  $daily_counts
     * @param  list<int>  $daily_median_seconds
     */
    public function __construct(
        public array $daily_counts,
        public array $daily_median_seconds,
        public int $failed,
        public ?int $median_change_seconds,
        public ?int $median_seconds,
        public int $succeeded,
        public ?float $success_rate,
        public int $total,
        public ?int $total_change_percent,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            daily_counts: array_map(static fn (mixed $value): int => (int) $value, self::listValue($data['daily_counts'])),
            daily_median_seconds: array_map(static fn (mixed $value): int => (int) $value, self::listValue($data['daily_median_seconds'])),
            failed: (int) $data['failed'],
            median_change_seconds: $data['median_change_seconds'] === null ? null : (int) $data['median_change_seconds'],
            median_seconds: $data['median_seconds'] === null ? null : (int) $data['median_seconds'],
            succeeded: (int) $data['succeeded'],
            success_rate: $data['success_rate'] === null ? null : (float) $data['success_rate'],
            total: (int) $data['total'],
            total_change_percent: $data['total_change_percent'] === null ? null : (int) $data['total_change_percent'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['daily_counts'] = $this->daily_counts;
        $data['daily_median_seconds'] = $this->daily_median_seconds;
        $data['failed'] = $this->failed;
        $data['median_change_seconds'] = $this->median_change_seconds === null ? null : $this->median_change_seconds;
        $data['median_seconds'] = $this->median_seconds === null ? null : $this->median_seconds;
        $data['succeeded'] = $this->succeeded;
        $data['success_rate'] = $this->success_rate === null ? null : $this->success_rate;
        $data['total'] = $this->total;
        $data['total_change_percent'] = $this->total_change_percent === null ? null : $this->total_change_percent;

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
