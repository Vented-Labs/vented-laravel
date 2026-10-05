<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class PlanCatalogTierData
{
    /**
     * @param  array<string, mixed>  $resources
     */
    public function __construct(
        public bool $featured,
        public string $id,
        public string $name,
        public string $price,
        public array $resources,
        public string $tagline,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            featured: (bool) $data['featured'],
            id: (string) $data['id'],
            name: (string) $data['name'],
            price: (string) $data['price'],
            resources: self::objectValue($data['resources']),
            tagline: (string) $data['tagline'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['featured'] = $this->featured;
        $data['id'] = $this->id;
        $data['name'] = $this->name;
        $data['price'] = $this->price;
        $data['resources'] = $this->resources;
        $data['tagline'] = $this->tagline;

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
