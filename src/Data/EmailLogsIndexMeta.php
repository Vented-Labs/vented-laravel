<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class EmailLogsIndexMeta
{
    /**
     * @param  list<FormOption>  $apps
     * @param  list<FormOption>  $statuses
     * @param  list<FormOption>  $windows
     */
    public function __construct(
        public array $apps,
        public bool $available,
        public string $domain_name,
        public int $retention_days,
        public array $statuses,
        public int $window_hours,
        public array $windows,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            apps: array_map(static fn (mixed $value): FormOption => FormOption::fromArray(self::objectValue($value)), self::listValue($data['apps'])),
            available: (bool) $data['available'],
            domain_name: (string) $data['domain_name'],
            retention_days: (int) $data['retention_days'],
            statuses: array_map(static fn (mixed $value): FormOption => FormOption::fromArray(self::objectValue($value)), self::listValue($data['statuses'])),
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
        $data['apps'] = array_map(static fn (FormOption $value) => $value->toArray(), $this->apps);
        $data['available'] = $this->available;
        $data['domain_name'] = $this->domain_name;
        $data['retention_days'] = $this->retention_days;
        $data['statuses'] = array_map(static fn (FormOption $value) => $value->toArray(), $this->statuses);
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
