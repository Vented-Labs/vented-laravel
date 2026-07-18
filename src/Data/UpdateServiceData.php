<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\OptionalValue;

final readonly class UpdateServiceData
{
    /**
     * @param  array<string, mixed>|OptionalValue  $configuration
     */
    public function __construct(
        public array|OptionalValue $configuration = OptionalValue::Missing,
        public string|OptionalValue $name = OptionalValue::Missing,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            configuration: array_key_exists('configuration', $data) ? self::objectValue($data['configuration']) : OptionalValue::Missing,
            name: array_key_exists('name', $data) ? (string) $data['name'] : OptionalValue::Missing,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->configuration !== OptionalValue::Missing) {
            $data['configuration'] = $this->configuration;
        }
        if ($this->name !== OptionalValue::Missing) {
            $data['name'] = $this->name;
        }

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
