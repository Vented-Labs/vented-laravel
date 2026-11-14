<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class AccountTwoFactorMeta
{
    /**
     * @param  list<AccountTwoFactorMetaPasskey>  $passkeys
     * @param  list<AccountTwoFactorMetaTotpMethod>  $totp_methods
     * @param  list<AccountTwoFactorMetaTrustedDevice>  $trusted_devices
     */
    public function __construct(
        public array $passkeys,
        public int $recovery_code_count,
        public array $totp_methods,
        public array $trusted_devices,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            passkeys: array_map(static fn (mixed $value): AccountTwoFactorMetaPasskey => AccountTwoFactorMetaPasskey::fromArray(self::objectValue($value)), self::listValue($data['passkeys'])),
            recovery_code_count: (int) $data['recovery_code_count'],
            totp_methods: array_map(static fn (mixed $value): AccountTwoFactorMetaTotpMethod => AccountTwoFactorMetaTotpMethod::fromArray(self::objectValue($value)), self::listValue($data['totp_methods'])),
            trusted_devices: array_map(static fn (mixed $value): AccountTwoFactorMetaTrustedDevice => AccountTwoFactorMetaTrustedDevice::fromArray(self::objectValue($value)), self::listValue($data['trusted_devices'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['passkeys'] = array_map(static fn (AccountTwoFactorMetaPasskey $value) => $value->toArray(), $this->passkeys);
        $data['recovery_code_count'] = $this->recovery_code_count;
        $data['totp_methods'] = array_map(static fn (AccountTwoFactorMetaTotpMethod $value) => $value->toArray(), $this->totp_methods);
        $data['trusted_devices'] = array_map(static fn (AccountTwoFactorMetaTrustedDevice $value) => $value->toArray(), $this->trusted_devices);

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
