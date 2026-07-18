<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\ObjectStorageProvider;

final readonly class ObjectStorageBackupsMetaStorage
{
    public function __construct(
        public string $name,
        public ?ObjectStorageProvider $provider,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            name: (string) $data['name'],
            provider: $data['provider'] === null ? null : ObjectStorageProvider::from((string) $data['provider']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['name'] = $this->name;
        $data['provider'] = $this->provider === null ? null : $this->provider->value;

        return $data;
    }
}
