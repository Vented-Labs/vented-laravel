<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ObjectStorageIndexMetaFormOptions
{
    /**
     * @param  list<ObjectStorageProviderOption>  $providers
     */
    public function __construct(
        public array $providers,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            providers: array_map(static fn (mixed $value): ObjectStorageProviderOption => ObjectStorageProviderOption::fromArray(self::objectValue($value)), self::listValue($data['providers'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['providers'] = array_map(static fn (ObjectStorageProviderOption $value) => $value->toArray(), $this->providers);

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
