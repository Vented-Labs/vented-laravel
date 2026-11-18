<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\TlsReason;

final readonly class BindingTlsData
{
    public function __construct(
        public BindingTlsActions $actions,
        public ?string $expires_at,
        public ?string $expiry_notice,
        public ?string $icon,
        public ?string $issuer,
        public ?string $reason,
        public ?TlsReason $reason_code,
        public StatusData $status,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            actions: BindingTlsActions::fromArray(self::objectValue($data['actions'])),
            expires_at: $data['expires_at'] === null ? null : (string) $data['expires_at'],
            expiry_notice: $data['expiry_notice'] === null ? null : (string) $data['expiry_notice'],
            icon: $data['icon'] === null ? null : (string) $data['icon'],
            issuer: $data['issuer'] === null ? null : (string) $data['issuer'],
            reason: $data['reason'] === null ? null : (string) $data['reason'],
            reason_code: $data['reason_code'] === null ? null : TlsReason::from((string) $data['reason_code']),
            status: StatusData::fromArray(self::objectValue($data['status'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['actions'] = $this->actions->toArray();
        $data['expires_at'] = $this->expires_at === null ? null : $this->expires_at;
        $data['expiry_notice'] = $this->expiry_notice === null ? null : $this->expiry_notice;
        $data['icon'] = $this->icon === null ? null : $this->icon;
        $data['issuer'] = $this->issuer === null ? null : $this->issuer;
        $data['reason'] = $this->reason === null ? null : $this->reason;
        $data['reason_code'] = $this->reason_code === null ? null : $this->reason_code->value;
        $data['status'] = $this->status->toArray();

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
