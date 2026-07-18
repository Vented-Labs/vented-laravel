<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\OptionalValue;

final readonly class JsonApiError
{
    public function __construct(
        public string $detail,
        public string $status,
        public string $title,
        public JsonApiErrorSource|OptionalValue $source = OptionalValue::Missing,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            detail: (string) $data['detail'],
            status: (string) $data['status'],
            title: (string) $data['title'],
            source: array_key_exists('source', $data) ? JsonApiErrorSource::fromArray(self::objectValue($data['source'])) : OptionalValue::Missing,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['detail'] = $this->detail;
        $data['status'] = $this->status;
        $data['title'] = $this->title;
        if ($this->source !== OptionalValue::Missing) {
            $data['source'] = $this->source->toArray();
        }

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
