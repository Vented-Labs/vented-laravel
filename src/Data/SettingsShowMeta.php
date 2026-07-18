<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class SettingsShowMeta
{
    /**
     * @param  list<SettingsGroup>  $settings_groups
     */
    public function __construct(
        public SettingsShowMetaCapabilities $capabilities,
        public array $settings_groups,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            capabilities: SettingsShowMetaCapabilities::fromArray(self::objectValue($data['capabilities'])),
            settings_groups: array_map(static fn (mixed $value): SettingsGroup => SettingsGroup::fromArray(self::objectValue($value)), self::listValue($data['settings_groups'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['capabilities'] = $this->capabilities->toArray();
        $data['settings_groups'] = array_map(static fn (SettingsGroup $value) => $value->toArray(), $this->settings_groups);

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
