<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\EnvironmentType;

final readonly class EnvironmentTransferEnvironmentData
{
    public function __construct(
        public string $id,
        public string $name,
        public string $slug,
        public EnvironmentType $type,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: (string) $data['id'],
            name: (string) $data['name'],
            slug: (string) $data['slug'],
            type: EnvironmentType::from((string) $data['type']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['id'] = $this->id;
        $data['name'] = $this->name;
        $data['slug'] = $this->slug;
        $data['type'] = $this->type->value;

        return $data;
    }
}
