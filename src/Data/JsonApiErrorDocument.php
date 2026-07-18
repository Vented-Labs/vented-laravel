<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class JsonApiErrorDocument
{
    /**
     * @param  list<JsonApiError>  $errors
     */
    public function __construct(
        public array $errors,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            errors: array_map(static fn (mixed $value): JsonApiError => JsonApiError::fromArray(self::objectValue($value)), self::listValue($data['errors'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['errors'] = array_map(static fn (JsonApiError $value) => $value->toArray(), $this->errors);

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
