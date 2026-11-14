<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class AccountOverviewMetaSecurity
{
    public function __construct(
        public int $passkey_count,
        public int $totp_count,
        public int $trusted_device_count,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            passkey_count: (int) $data['passkey_count'],
            totp_count: (int) $data['totp_count'],
            trusted_device_count: (int) $data['trusted_device_count'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['passkey_count'] = $this->passkey_count;
        $data['totp_count'] = $this->totp_count;
        $data['trusted_device_count'] = $this->trusted_device_count;

        return $data;
    }
}
