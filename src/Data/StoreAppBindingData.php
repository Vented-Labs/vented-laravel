<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\BindableType;
use Vented\Enums\PortType;

final readonly class StoreAppBindingData
{
    public function __construct(
        public string $bindable_id,
        public BindableType $bindable_type,
        public string $hostname,
        public ?int $port,
        public PortType $port_type,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            bindable_id: (string) $data['bindable_id'],
            bindable_type: BindableType::from((string) $data['bindable_type']),
            hostname: (string) $data['hostname'],
            port: $data['port'] === null ? null : (int) $data['port'],
            port_type: PortType::from((string) $data['port_type']),
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
        $data['hostname'] = $this->hostname;
        $data['port'] = $this->port === null ? null : $this->port;
        $data['port_type'] = $this->port_type->value;

        return $data;
    }
}
