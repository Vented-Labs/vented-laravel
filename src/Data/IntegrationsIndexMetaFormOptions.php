<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class IntegrationsIndexMetaFormOptions
{
    /**
     * @param  list<FormOption>  $providers
     * @param  list<FormOption>  $types
     */
    public function __construct(
        public array $providers,
        public array $types,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            providers: array_map(static fn (mixed $value): FormOption => FormOption::fromArray(self::objectValue($value)), self::listValue($data['providers'])),
            types: array_map(static fn (mixed $value): FormOption => FormOption::fromArray(self::objectValue($value)), self::listValue($data['types'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['providers'] = array_map(static fn (FormOption $value) => $value->toArray(), $this->providers);
        $data['types'] = array_map(static fn (FormOption $value) => $value->toArray(), $this->types);

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
