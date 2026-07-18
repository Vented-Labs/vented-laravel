<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ObjectStorageProviderOption
{
    /**
     * @param  list<FormOption>  $regions
     */
    public function __construct(
        public string $description,
        public string $label,
        public array $regions,
        public bool $requiresCredentials,
        public bool $supportsRegions,
        public string $value,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            description: (string) $data['description'],
            label: (string) $data['label'],
            regions: array_map(static fn (mixed $value): FormOption => FormOption::fromArray(self::objectValue($value)), self::listValue($data['regions'])),
            requiresCredentials: (bool) $data['requiresCredentials'],
            supportsRegions: (bool) $data['supportsRegions'],
            value: (string) $data['value'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['description'] = $this->description;
        $data['label'] = $this->label;
        $data['regions'] = array_map(static fn (FormOption $value) => $value->toArray(), $this->regions);
        $data['requiresCredentials'] = $this->requiresCredentials;
        $data['supportsRegions'] = $this->supportsRegions;
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
