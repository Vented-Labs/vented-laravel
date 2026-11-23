<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class PlanCatalogTierData
{
    /**
     * @param  array<string, mixed>  $resources
     */
    public function __construct(
        public ?int $capacity_max,
        public bool $featured,
        public string $id,
        public PlanLimitsData $limits,
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
            capacity_max: $data['capacity_max'] === null ? null : (int) $data['capacity_max'],
            featured: (bool) $data['featured'],
            id: (string) $data['id'],
            limits: PlanLimitsData::fromArray(self::objectValue($data['limits'])),
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
        $data['capacity_max'] = $this->capacity_max === null ? null : $this->capacity_max;
        $data['featured'] = $this->featured;
        $data['id'] = $this->id;
        $data['limits'] = $this->limits->toArray();
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
