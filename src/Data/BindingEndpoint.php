<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class BindingEndpoint
{
    public function __construct(
        public ?string $icon,
        public string $name,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            icon: $data['icon'] === null ? null : (string) $data['icon'],
            name: (string) $data['name'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['icon'] = $this->icon === null ? null : $this->icon;
        $data['name'] = $this->name;

        return $data;
    }
}
