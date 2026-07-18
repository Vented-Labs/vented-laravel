<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\OptionalValue;

final readonly class UpdateAppData
{
    /**
     * @param  list<StoreAppBlockStorageAttachmentData>|OptionalValue  $block_storage_attachments
     * @param  array<string, mixed>|OptionalValue  $configuration
     */
    public function __construct(
        public array|OptionalValue $block_storage_attachments = OptionalValue::Missing,
        public array|OptionalValue $configuration = OptionalValue::Missing,
        public string|OptionalValue $name = OptionalValue::Missing,
        public string|OptionalValue $version = OptionalValue::Missing,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            block_storage_attachments: array_key_exists('block_storage_attachments', $data) ? array_map(static fn (mixed $value): StoreAppBlockStorageAttachmentData => StoreAppBlockStorageAttachmentData::fromArray(self::objectValue($value)), self::listValue($data['block_storage_attachments'])) : OptionalValue::Missing,
            configuration: array_key_exists('configuration', $data) ? self::objectValue($data['configuration']) : OptionalValue::Missing,
            name: array_key_exists('name', $data) ? (string) $data['name'] : OptionalValue::Missing,
            version: array_key_exists('version', $data) ? (string) $data['version'] : OptionalValue::Missing,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->block_storage_attachments !== OptionalValue::Missing) {
            $data['block_storage_attachments'] = array_map(static fn (StoreAppBlockStorageAttachmentData $value) => $value->toArray(), $this->block_storage_attachments);
        }
        if ($this->configuration !== OptionalValue::Missing) {
            $data['configuration'] = $this->configuration;
        }
        if ($this->name !== OptionalValue::Missing) {
            $data['name'] = $this->name;
        }
        if ($this->version !== OptionalValue::Missing) {
            $data['version'] = $this->version;
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
