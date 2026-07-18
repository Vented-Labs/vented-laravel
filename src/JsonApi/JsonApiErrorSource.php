<?php

declare(strict_types=1);

namespace Vented\JsonApi;

final readonly class JsonApiErrorSource
{
    public function __construct(
        public ?string $pointer = null,
        public ?string $parameter = null,
        public ?string $header = null,
    ) {}

    /**
     * @param  array<string, mixed>  $source
     */
    public static function fromArray(array $source): self
    {
        return new self(
            pointer: self::string($source, 'pointer'),
            parameter: self::string($source, 'parameter'),
            header: self::string($source, 'header'),
        );
    }

    /**
     * @param  array<string, mixed>  $values
     */
    private static function string(array $values, string $key): ?string
    {
        $value = $values[$key] ?? null;

        return is_string($value) ? $value : null;
    }
}
