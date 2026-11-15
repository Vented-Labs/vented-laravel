<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ApiTokenExpiryData
{
    /**
     * @param  list<FormOption>  $options
     */
    public function __construct(
        public string $default,
        public int $keep_expired_days,
        public string $latest,
        public array $options,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            default: (string) $data['default'],
            keep_expired_days: (int) $data['keep_expired_days'],
            latest: (string) $data['latest'],
            options: array_map(static fn (mixed $value): FormOption => FormOption::fromArray(self::objectValue($value)), self::listValue($data['options'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['default'] = $this->default;
        $data['keep_expired_days'] = $this->keep_expired_days;
        $data['latest'] = $this->latest;
        $data['options'] = array_map(static fn (FormOption $value) => $value->toArray(), $this->options);

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
