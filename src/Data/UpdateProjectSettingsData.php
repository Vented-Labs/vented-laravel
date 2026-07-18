<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class UpdateProjectSettingsData
{
    /**
     * @param  array<string, mixed>  $settings
     */
    public function __construct(
        public array $settings,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            settings: self::objectValue($data['settings']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['settings'] = $this->settings;

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
