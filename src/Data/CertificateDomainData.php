<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\BindableType;
use Vented\Enums\TlsMode;

final readonly class CertificateDomainData
{
    public function __construct(
        public string $bindable_name,
        public BindableType $bindable_type,
        public ?CertificateRef $certificate,
        public bool $covered,
        public EnvironmentRef $environment,
        public string $hostname,
        public string $id,
        public bool $installed,
        public BindingTlsData $tls,
        public TlsMode $tls_mode,
        public string $zone_domain,
        public string $zone_id,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            bindable_name: (string) $data['bindable_name'],
            bindable_type: BindableType::from((string) $data['bindable_type']),
            certificate: $data['certificate'] === null ? null : CertificateRef::fromArray(self::objectValue($data['certificate'])),
            covered: (bool) $data['covered'],
            environment: EnvironmentRef::fromArray(self::objectValue($data['environment'])),
            hostname: (string) $data['hostname'],
            id: (string) $data['id'],
            installed: (bool) $data['installed'],
            tls: BindingTlsData::fromArray(self::objectValue($data['tls'])),
            tls_mode: TlsMode::from((string) $data['tls_mode']),
            zone_domain: (string) $data['zone_domain'],
            zone_id: (string) $data['zone_id'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['bindable_name'] = $this->bindable_name;
        $data['bindable_type'] = $this->bindable_type->value;
        $data['certificate'] = $this->certificate === null ? null : $this->certificate->toArray();
        $data['covered'] = $this->covered;
        $data['environment'] = $this->environment->toArray();
        $data['hostname'] = $this->hostname;
        $data['id'] = $this->id;
        $data['installed'] = $this->installed;
        $data['tls'] = $this->tls->toArray();
        $data['tls_mode'] = $this->tls_mode->value;
        $data['zone_domain'] = $this->zone_domain;
        $data['zone_id'] = $this->zone_id;

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
