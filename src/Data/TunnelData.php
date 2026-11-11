<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\TunnelAccess;
use Vented\Enums\TunnelType;

final readonly class TunnelData
{
    public function __construct(
        public TunnelAccess $access,
        public TunnelActions $actions,
        public ?string $connected_at,
        public string $created_at,
        public ?string $endpoint,
        public ?string $expires_at,
        public string $id,
        public string $name,
        public ?int $port,
        public StatusData $status,
        public string $target,
        public ?int $transfer_bytes,
        public TunnelType $type,
        public string $updated_at,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            access: TunnelAccess::from((string) $data['access']),
            actions: TunnelActions::fromArray(self::objectValue($data['actions'])),
            connected_at: $data['connected_at'] === null ? null : (string) $data['connected_at'],
            created_at: (string) $data['created_at'],
            endpoint: $data['endpoint'] === null ? null : (string) $data['endpoint'],
            expires_at: $data['expires_at'] === null ? null : (string) $data['expires_at'],
            id: (string) $data['id'],
            name: (string) $data['name'],
            port: $data['port'] === null ? null : (int) $data['port'],
            status: StatusData::fromArray(self::objectValue($data['status'])),
            target: (string) $data['target'],
            transfer_bytes: $data['transfer_bytes'] === null ? null : (int) $data['transfer_bytes'],
            type: TunnelType::from((string) $data['type']),
            updated_at: (string) $data['updated_at'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['access'] = $this->access->value;
        $data['actions'] = $this->actions->toArray();
        $data['connected_at'] = $this->connected_at === null ? null : $this->connected_at;
        $data['created_at'] = $this->created_at;
        $data['endpoint'] = $this->endpoint === null ? null : $this->endpoint;
        $data['expires_at'] = $this->expires_at === null ? null : $this->expires_at;
        $data['id'] = $this->id;
        $data['name'] = $this->name;
        $data['port'] = $this->port === null ? null : $this->port;
        $data['status'] = $this->status->toArray();
        $data['target'] = $this->target;
        $data['transfer_bytes'] = $this->transfer_bytes === null ? null : $this->transfer_bytes;
        $data['type'] = $this->type->value;
        $data['updated_at'] = $this->updated_at;

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
