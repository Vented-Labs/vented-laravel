<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class BuildStorageOption
{
    /**
     * @param  list<BuildConfigStorageApp>  $apps
     */
    public function __construct(
        public array $apps,
        public ?string $builds_config_id,
        public ?string $description,
        public string $label,
        public string $value,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            apps: array_map(static fn (mixed $value): BuildConfigStorageApp => BuildConfigStorageApp::fromArray(self::objectValue($value)), self::listValue($data['apps'])),
            builds_config_id: $data['builds_config_id'] === null ? null : (string) $data['builds_config_id'],
            description: $data['description'] === null ? null : (string) $data['description'],
            label: (string) $data['label'],
            value: (string) $data['value'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['apps'] = array_map(static fn (BuildConfigStorageApp $value) => $value->toArray(), $this->apps);
        $data['builds_config_id'] = $this->builds_config_id === null ? null : $this->builds_config_id;
        $data['description'] = $this->description === null ? null : $this->description;
        $data['label'] = $this->label;
        $data['value'] = $this->value;

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
