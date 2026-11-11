<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ServiceCatalogEntry
{
    /**
     * @param  list<FormSchemaField>  $schema
     */
    public function __construct(
        public ?string $area,
        public bool $available,
        public ?string $icon,
        public string $identifier,
        public ?string $kind,
        public string $name,
        public ?string $reason,
        public array $schema,
        public ?string $service_name,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            area: $data['area'] === null ? null : (string) $data['area'],
            available: (bool) $data['available'],
            icon: $data['icon'] === null ? null : (string) $data['icon'],
            identifier: (string) $data['identifier'],
            kind: $data['kind'] === null ? null : (string) $data['kind'],
            name: (string) $data['name'],
            reason: $data['reason'] === null ? null : (string) $data['reason'],
            schema: array_map(static fn (mixed $value): FormSchemaField => FormSchemaField::fromArray(self::objectValue($value)), self::listValue($data['schema'])),
            service_name: $data['service_name'] === null ? null : (string) $data['service_name'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['area'] = $this->area === null ? null : $this->area;
        $data['available'] = $this->available;
        $data['icon'] = $this->icon === null ? null : $this->icon;
        $data['identifier'] = $this->identifier;
        $data['kind'] = $this->kind === null ? null : $this->kind;
        $data['name'] = $this->name;
        $data['reason'] = $this->reason === null ? null : $this->reason;
        $data['schema'] = array_map(static fn (FormSchemaField $value) => $value->toArray(), $this->schema);
        $data['service_name'] = $this->service_name === null ? null : $this->service_name;

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
