<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class StoreObjectStorageData
{
    public function __construct(
        public string $access,
        public ?string $access_key_id,
        public ?string $bucket,
        public ?string $endpoint,
        public string $name,
        public string $provider,
        public ?string $region,
        public ?string $secret_access_key,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            access: (string) $data['access'],
            access_key_id: $data['access_key_id'] === null ? null : (string) $data['access_key_id'],
            bucket: $data['bucket'] === null ? null : (string) $data['bucket'],
            endpoint: $data['endpoint'] === null ? null : (string) $data['endpoint'],
            name: (string) $data['name'],
            provider: (string) $data['provider'],
            region: $data['region'] === null ? null : (string) $data['region'],
            secret_access_key: $data['secret_access_key'] === null ? null : (string) $data['secret_access_key'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['access'] = $this->access;
        $data['access_key_id'] = $this->access_key_id === null ? null : $this->access_key_id;
        $data['bucket'] = $this->bucket === null ? null : $this->bucket;
        $data['endpoint'] = $this->endpoint === null ? null : $this->endpoint;
        $data['name'] = $this->name;
        $data['provider'] = $this->provider;
        $data['region'] = $this->region === null ? null : $this->region;
        $data['secret_access_key'] = $this->secret_access_key === null ? null : $this->secret_access_key;

        return $data;
    }
}
