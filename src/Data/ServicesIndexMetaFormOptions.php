<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ServicesIndexMetaFormOptions
{
    /**
     * @param  list<ServiceCatalogEntry>  $available_services
     */
    public function __construct(
        public array $available_services,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            available_services: array_map(static fn (mixed $value): ServiceCatalogEntry => ServiceCatalogEntry::fromArray(self::objectValue($value)), self::listValue($data['available_services'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['available_services'] = array_map(static fn (ServiceCatalogEntry $value) => $value->toArray(), $this->available_services);

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
