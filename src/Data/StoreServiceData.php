<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class StoreServiceData
{
    /**
     * @param  array<string, mixed>  $configuration
     */
    public function __construct(
        public array $configuration,
        public string $name,
        public string $type,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            configuration: self::objectValue($data['configuration']),
            name: (string) $data['name'],
            type: (string) $data['type'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['configuration'] = $this->configuration;
        $data['name'] = $this->name;
        $data['type'] = $this->type;

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
