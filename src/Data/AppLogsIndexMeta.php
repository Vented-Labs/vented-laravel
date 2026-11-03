<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class AppLogsIndexMeta
{
    /**
     * @param  list<AppEventData>  $events
     * @param  list<FormOption>  $windows
     */
    public function __construct(
        public string $app_name,
        public bool $available,
        public array $events,
        public int $retention_days,
        public int $window_hours,
        public array $windows,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            app_name: (string) $data['app_name'],
            available: (bool) $data['available'],
            events: array_map(static fn (mixed $value): AppEventData => AppEventData::fromArray(self::objectValue($value)), self::listValue($data['events'])),
            retention_days: (int) $data['retention_days'],
            window_hours: (int) $data['window_hours'],
            windows: array_map(static fn (mixed $value): FormOption => FormOption::fromArray(self::objectValue($value)), self::listValue($data['windows'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['app_name'] = $this->app_name;
        $data['available'] = $this->available;
        $data['events'] = array_map(static fn (AppEventData $value) => $value->toArray(), $this->events);
        $data['retention_days'] = $this->retention_days;
        $data['window_hours'] = $this->window_hours;
        $data['windows'] = array_map(static fn (FormOption $value) => $value->toArray(), $this->windows);

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
