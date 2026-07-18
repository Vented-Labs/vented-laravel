<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class StoreAppData
{
    /**
     * @param  list<StoreAppBlockStorageAttachmentData>  $block_storage_attachments
     * @param  array<string, mixed>  $configuration
     */
    public function __construct(
        public string $app_name,
        public array $block_storage_attachments,
        public array $configuration,
        public string $installable,
        public string $installable_type,
        public string $version,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            app_name: (string) $data['app_name'],
            block_storage_attachments: array_map(static fn (mixed $value): StoreAppBlockStorageAttachmentData => StoreAppBlockStorageAttachmentData::fromArray(self::objectValue($value)), self::listValue($data['block_storage_attachments'])),
            configuration: self::objectValue($data['configuration']),
            installable: (string) $data['installable'],
            installable_type: (string) $data['installable_type'],
            version: (string) $data['version'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['app_name'] = $this->app_name;
        $data['block_storage_attachments'] = array_map(static fn (StoreAppBlockStorageAttachmentData $value) => $value->toArray(), $this->block_storage_attachments);
        $data['configuration'] = $this->configuration;
        $data['installable'] = $this->installable;
        $data['installable_type'] = $this->installable_type;
        $data['version'] = $this->version;

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
