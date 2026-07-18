<?php

declare(strict_types=1);

namespace Vented\JsonApi;

final readonly class JsonApiError
{
    /**
     * @param  array<string, mixed>  $links
     * @param  array<string, mixed>  $meta
     */
    public function __construct(
        public ?string $id = null,
        public ?string $status = null,
        public ?string $code = null,
        public ?string $title = null,
        public ?string $detail = null,
        public ?JsonApiErrorSource $source = null,
        public array $links = [],
        public array $meta = [],
    ) {}

    /**
     * @param  array<string, mixed>  $error
     */
    public static function fromArray(array $error): self
    {
        $source = $error['source'] ?? null;

        return new self(
            id: self::string($error, 'id'),
            status: self::string($error, 'status'),
            code: self::string($error, 'code'),
            title: self::string($error, 'title'),
            detail: self::string($error, 'detail'),
            source: is_array($source) ? JsonApiErrorSource::fromArray($source) : null,
            links: self::array($error, 'links'),
            meta: self::array($error, 'meta'),
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

    /**
     * @param  array<string, mixed>  $values
     * @return array<string, mixed>
     */
    private static function array(array $values, string $key): array
    {
        $value = $values[$key] ?? null;

        return is_array($value) ? $value : [];
    }
}
