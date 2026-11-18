<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\BindableType;
use Vented\Enums\PortType;
use Vented\Enums\TlsMode;
use Vented\OptionalValue;

final readonly class UpdateAppBindingData
{
    public function __construct(
        public string $bindable_id,
        public BindableType $bindable_type,
        public string $environment_id,
        public string $hostname,
        public ?int $port,
        public PortType $port_type,
        public string|null|OptionalValue $certificate_id = OptionalValue::Missing,
        public TlsMode|OptionalValue $tls_mode = OptionalValue::Missing,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            bindable_id: (string) $data['bindable_id'],
            bindable_type: BindableType::from((string) $data['bindable_type']),
            environment_id: (string) $data['environment_id'],
            hostname: (string) $data['hostname'],
            port: $data['port'] === null ? null : (int) $data['port'],
            port_type: PortType::from((string) $data['port_type']),
            certificate_id: array_key_exists('certificate_id', $data) ? $data['certificate_id'] === null ? null : (string) $data['certificate_id'] : OptionalValue::Missing,
            tls_mode: array_key_exists('tls_mode', $data) ? TlsMode::from((string) $data['tls_mode']) : OptionalValue::Missing,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['bindable_id'] = $this->bindable_id;
        $data['bindable_type'] = $this->bindable_type->value;
        $data['environment_id'] = $this->environment_id;
        $data['hostname'] = $this->hostname;
        $data['port'] = $this->port === null ? null : $this->port;
        $data['port_type'] = $this->port_type->value;
        if ($this->certificate_id !== OptionalValue::Missing) {
            $data['certificate_id'] = $this->certificate_id === null ? null : $this->certificate_id;
        }
        if ($this->tls_mode !== OptionalValue::Missing) {
            $data['tls_mode'] = $this->tls_mode->value;
        }

        return $data;
    }
}
