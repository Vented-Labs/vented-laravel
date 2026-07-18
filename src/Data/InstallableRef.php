<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class InstallableRef
{
    public function __construct(
        public ?string $icon,
        public string $id,
        public string $name,
        public string $version,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            icon: $data['icon'] === null ? null : (string) $data['icon'],
            id: (string) $data['id'],
            name: (string) $data['name'],
            version: (string) $data['version'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['icon'] = $this->icon === null ? null : $this->icon;
        $data['id'] = $this->id;
        $data['name'] = $this->name;
        $data['version'] = $this->version;

        return $data;
    }
}
