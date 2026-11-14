<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class AccountTwoFactorMetaTrustedDevice
{
    public function __construct(
        public ?string $created_at,
        public ?string $device_name,
        public string $id,
        public ?string $ip_address,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            created_at: $data['created_at'] === null ? null : (string) $data['created_at'],
            device_name: $data['device_name'] === null ? null : (string) $data['device_name'],
            id: (string) $data['id'],
            ip_address: $data['ip_address'] === null ? null : (string) $data['ip_address'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['created_at'] = $this->created_at === null ? null : $this->created_at;
        $data['device_name'] = $this->device_name === null ? null : $this->device_name;
        $data['id'] = $this->id;
        $data['ip_address'] = $this->ip_address === null ? null : $this->ip_address;

        return $data;
    }
}
