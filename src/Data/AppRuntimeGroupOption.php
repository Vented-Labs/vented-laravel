<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class AppRuntimeGroupOption
{
    public function __construct(
        public ?string $description,
        public ?string $icon,
        public string $identifier,
        public string $name,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            description: $data['description'] === null ? null : (string) $data['description'],
            icon: $data['icon'] === null ? null : (string) $data['icon'],
            identifier: (string) $data['identifier'],
            name: (string) $data['name'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['description'] = $this->description === null ? null : $this->description;
        $data['icon'] = $this->icon === null ? null : $this->icon;
        $data['identifier'] = $this->identifier;
        $data['name'] = $this->name;

        return $data;
    }
}
