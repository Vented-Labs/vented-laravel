<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class PlatformLocationData
{
    public function __construct(
        public string $country,
        public ?string $facility,
        public string $id,
        public string $name,
        public string $slug,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            country: (string) $data['country'],
            facility: $data['facility'] === null ? null : (string) $data['facility'],
            id: (string) $data['id'],
            name: (string) $data['name'],
            slug: (string) $data['slug'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['country'] = $this->country;
        $data['facility'] = $this->facility === null ? null : $this->facility;
        $data['id'] = $this->id;
        $data['name'] = $this->name;
        $data['slug'] = $this->slug;

        return $data;
    }
}
