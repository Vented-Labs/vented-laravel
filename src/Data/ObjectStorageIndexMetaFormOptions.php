<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ObjectStorageIndexMetaFormOptions
{
    /**
     * @param  list<ObjectStorageProviderOption>  $providers
     * @param  list<S3ProviderOption>  $s3_providers
     */
    public function __construct(
        public array $providers,
        public array $s3_providers,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            providers: array_map(static fn (mixed $value): ObjectStorageProviderOption => ObjectStorageProviderOption::fromArray(self::objectValue($value)), self::listValue($data['providers'])),
            s3_providers: array_map(static fn (mixed $value): S3ProviderOption => S3ProviderOption::fromArray(self::objectValue($value)), self::listValue($data['s3_providers'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['providers'] = array_map(static fn (ObjectStorageProviderOption $value) => $value->toArray(), $this->providers);
        $data['s3_providers'] = array_map(static fn (S3ProviderOption $value) => $value->toArray(), $this->s3_providers);

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
