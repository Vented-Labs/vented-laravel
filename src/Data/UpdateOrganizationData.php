<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\OptionalValue;

final readonly class UpdateOrganizationData
{
    /**
     * @param  array<string, mixed>|OptionalValue  $settings
     */
    public function __construct(
        public string|OptionalValue $name = OptionalValue::Missing,
        public array|OptionalValue $settings = OptionalValue::Missing,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            name: array_key_exists('name', $data) ? (string) $data['name'] : OptionalValue::Missing,
            settings: array_key_exists('settings', $data) ? self::objectValue($data['settings']) : OptionalValue::Missing,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->name !== OptionalValue::Missing) {
            $data['name'] = $this->name;
        }
        if ($this->settings !== OptionalValue::Missing) {
            $data['settings'] = $this->settings;
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
