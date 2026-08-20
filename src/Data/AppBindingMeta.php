<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\BindableType;
use Vented\Enums\PortType;

final readonly class AppBindingMeta
{
    public function __construct(
        public string $bindable_id,
        public string $bindable_name,
        public BindableType $bindable_type,
        public EnvironmentRef $environment,
        public string $hostname,
        public string $id,
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
            bindable_name: (string) $data['bindable_name'],
            bindable_type: BindableType::from((string) $data['bindable_type']),
            environment: EnvironmentRef::fromArray(self::objectValue($data['environment'])),
            hostname: (string) $data['hostname'],
            id: (string) $data['id'],
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
        $data['bindable_name'] = $this->bindable_name;
        $data['bindable_type'] = $this->bindable_type->value;
        $data['environment'] = $this->environment->toArray();
        $data['hostname'] = $this->hostname;
        $data['id'] = $this->id;
        $data['port'] = $this->port === null ? null : $this->port;
        $data['port_type'] = $this->port_type->value;

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
