<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class BillingBandwidthData
{
    /**
     * @param  list<string>  $allocation_errors
     * @param  list<string>  $report_errors
     */
    public function __construct(
        public StatusData $account_cap_state,
        public array $allocation_errors,
        public StatusData $cap_state,
        public ?int $consumed_bytes,
        public ?int $desired_rate_limit_bps,
        public ?bool $fresh,
        public ?int $included_bytes,
        public ?int $included_remaining_bytes,
        public ?string $ingestion_error,
        public StatusData $ingestion_state,
        public ?string $measured_at,
        public ?string $period_ends_at,
        public int $purchased_remaining_bytes,
        public array $report_errors,
        public StatusData $reporting_state,
        public int $unreported_intervals,
        public int $unresolved_intervals,
        public ?string $watermark_at,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            account_cap_state: StatusData::fromArray(self::objectValue($data['account_cap_state'])),
            allocation_errors: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['allocation_errors'])),
            cap_state: StatusData::fromArray(self::objectValue($data['cap_state'])),
            consumed_bytes: $data['consumed_bytes'] === null ? null : (int) $data['consumed_bytes'],
            desired_rate_limit_bps: $data['desired_rate_limit_bps'] === null ? null : (int) $data['desired_rate_limit_bps'],
            fresh: $data['fresh'] === null ? null : (bool) $data['fresh'],
            included_bytes: $data['included_bytes'] === null ? null : (int) $data['included_bytes'],
            included_remaining_bytes: $data['included_remaining_bytes'] === null ? null : (int) $data['included_remaining_bytes'],
            ingestion_error: $data['ingestion_error'] === null ? null : (string) $data['ingestion_error'],
            ingestion_state: StatusData::fromArray(self::objectValue($data['ingestion_state'])),
            measured_at: $data['measured_at'] === null ? null : (string) $data['measured_at'],
            period_ends_at: $data['period_ends_at'] === null ? null : (string) $data['period_ends_at'],
            purchased_remaining_bytes: (int) $data['purchased_remaining_bytes'],
            report_errors: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['report_errors'])),
            reporting_state: StatusData::fromArray(self::objectValue($data['reporting_state'])),
            unreported_intervals: (int) $data['unreported_intervals'],
            unresolved_intervals: (int) $data['unresolved_intervals'],
            watermark_at: $data['watermark_at'] === null ? null : (string) $data['watermark_at'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['account_cap_state'] = $this->account_cap_state->toArray();
        $data['allocation_errors'] = $this->allocation_errors;
        $data['cap_state'] = $this->cap_state->toArray();
        $data['consumed_bytes'] = $this->consumed_bytes === null ? null : $this->consumed_bytes;
        $data['desired_rate_limit_bps'] = $this->desired_rate_limit_bps === null ? null : $this->desired_rate_limit_bps;
        $data['fresh'] = $this->fresh === null ? null : $this->fresh;
        $data['included_bytes'] = $this->included_bytes === null ? null : $this->included_bytes;
        $data['included_remaining_bytes'] = $this->included_remaining_bytes === null ? null : $this->included_remaining_bytes;
        $data['ingestion_error'] = $this->ingestion_error === null ? null : $this->ingestion_error;
        $data['ingestion_state'] = $this->ingestion_state->toArray();
        $data['measured_at'] = $this->measured_at === null ? null : $this->measured_at;
        $data['period_ends_at'] = $this->period_ends_at === null ? null : $this->period_ends_at;
        $data['purchased_remaining_bytes'] = $this->purchased_remaining_bytes;
        $data['report_errors'] = $this->report_errors;
        $data['reporting_state'] = $this->reporting_state->toArray();
        $data['unreported_intervals'] = $this->unreported_intervals;
        $data['unresolved_intervals'] = $this->unresolved_intervals;
        $data['watermark_at'] = $this->watermark_at === null ? null : $this->watermark_at;

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
