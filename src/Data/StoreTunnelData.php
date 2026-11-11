<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\TunnelAccess;
use Vented\Enums\TunnelType;

final readonly class StoreTunnelData
{
    public function __construct(
        public TunnelAccess $access,
        public ?string $expires_at,
        public string $name,
        public ?int $port,
        public string $target,
        public TunnelType $type,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            access: TunnelAccess::from((string) $data['access']),
            expires_at: $data['expires_at'] === null ? null : (string) $data['expires_at'],
            name: (string) $data['name'],
            port: $data['port'] === null ? null : (int) $data['port'],
            target: (string) $data['target'],
            type: TunnelType::from((string) $data['type']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['access'] = $this->access->value;
        $data['expires_at'] = $this->expires_at === null ? null : $this->expires_at;
        $data['name'] = $this->name;
        $data['port'] = $this->port === null ? null : $this->port;
        $data['target'] = $this->target;
        $data['type'] = $this->type->value;

        return $data;
    }
}
