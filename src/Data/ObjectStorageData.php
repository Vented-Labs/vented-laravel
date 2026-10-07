<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\ObjectStorageProvider;

final readonly class ObjectStorageData
{
    public function __construct(
        public string $access,
        public ?string $bucket,
        public ?string $created_at,
        public ?string $endpoint,
        public string $id,
        public string $name,
        public ?ObjectStorageProvider $provider,
        public ?string $region,
        public ?StatusData $status,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            access: (string) $data['access'],
            bucket: $data['bucket'] === null ? null : (string) $data['bucket'],
            created_at: $data['created_at'] === null ? null : (string) $data['created_at'],
            endpoint: $data['endpoint'] === null ? null : (string) $data['endpoint'],
            id: (string) $data['id'],
            name: (string) $data['name'],
            provider: $data['provider'] === null ? null : ObjectStorageProvider::from((string) $data['provider']),
            region: $data['region'] === null ? null : (string) $data['region'],
            status: $data['status'] === null ? null : StatusData::fromArray(self::objectValue($data['status'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['access'] = $this->access;
        $data['bucket'] = $this->bucket === null ? null : $this->bucket;
        $data['created_at'] = $this->created_at === null ? null : $this->created_at;
        $data['endpoint'] = $this->endpoint === null ? null : $this->endpoint;
        $data['id'] = $this->id;
        $data['name'] = $this->name;
        $data['provider'] = $this->provider === null ? null : $this->provider->value;
        $data['region'] = $this->region === null ? null : $this->region;
        $data['status'] = $this->status === null ? null : $this->status->toArray();

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
