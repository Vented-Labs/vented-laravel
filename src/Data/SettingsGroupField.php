<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class SettingsGroupField
{
    public function __construct(
        public bool $changeable,
        public string $component,
        public ?string $description,
        public string $key,
        public string $label,
        public ?string $options,
        public string $type,
        public bool $visible,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            changeable: (bool) $data['changeable'],
            component: (string) $data['component'],
            description: $data['description'] === null ? null : (string) $data['description'],
            key: (string) $data['key'],
            label: (string) $data['label'],
            options: $data['options'] === null ? null : (string) $data['options'],
            type: (string) $data['type'],
            visible: (bool) $data['visible'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['changeable'] = $this->changeable;
        $data['component'] = $this->component;
        $data['description'] = $this->description === null ? null : $this->description;
        $data['key'] = $this->key;
        $data['label'] = $this->label;
        $data['options'] = $this->options === null ? null : $this->options;
        $data['type'] = $this->type;
        $data['visible'] = $this->visible;

        return $data;
    }
}
