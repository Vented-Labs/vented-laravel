<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class SupportOverviewMeta
{
    /**
     * @param  list<SupportOverviewMetaOpenTicket>  $open_tickets
     * @param  list<SupportOverviewMetaStat>  $stats_display
     */
    public function __construct(
        public array $open_tickets,
        public array $stats_display,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            open_tickets: array_map(static fn (mixed $value): SupportOverviewMetaOpenTicket => SupportOverviewMetaOpenTicket::fromArray(self::objectValue($value)), self::listValue($data['open_tickets'])),
            stats_display: array_map(static fn (mixed $value): SupportOverviewMetaStat => SupportOverviewMetaStat::fromArray(self::objectValue($value)), self::listValue($data['stats_display'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['open_tickets'] = array_map(static fn (SupportOverviewMetaOpenTicket $value) => $value->toArray(), $this->open_tickets);
        $data['stats_display'] = array_map(static fn (SupportOverviewMetaStat $value) => $value->toArray(), $this->stats_display);

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
