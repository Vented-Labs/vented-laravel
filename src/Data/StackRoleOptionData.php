<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class StackRoleOptionData
{
    /**
     * @param  list<string>  $provisionable_versions
     * @param  list<string>  $versions
     */
    public function __construct(
        public StackOptionAvailabilityData $availability,
        public ?string $category,
        public string $identifier,
        public string $kind,
        public string $label,
        public int $minimum_size_mb,
        public array $provisionable_versions,
        public bool $shareable,
        public array $versions,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            availability: StackOptionAvailabilityData::fromArray(self::objectValue($data['availability'])),
            category: $data['category'] === null ? null : (string) $data['category'],
            identifier: (string) $data['identifier'],
            kind: (string) $data['kind'],
            label: (string) $data['label'],
            minimum_size_mb: (int) $data['minimum_size_mb'],
            provisionable_versions: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['provisionable_versions'])),
            shareable: (bool) $data['shareable'],
            versions: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['versions'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['availability'] = $this->availability->toArray();
        $data['category'] = $this->category === null ? null : $this->category;
        $data['identifier'] = $this->identifier;
        $data['kind'] = $this->kind;
        $data['label'] = $this->label;
        $data['minimum_size_mb'] = $this->minimum_size_mb;
        $data['provisionable_versions'] = $this->provisionable_versions;
        $data['shareable'] = $this->shareable;
        $data['versions'] = $this->versions;

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
