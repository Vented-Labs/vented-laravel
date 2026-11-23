<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\GitConnectMode;
use Vented\Enums\GitProvider;

final readonly class GitConnectionData
{
    /**
     * @param  list<string>  $project_ids
     */
    public function __construct(
        public string $account_name,
        public string $account_type,
        public GitConnectMode $connect_mode,
        public ?string $connected_by,
        public string $created_at,
        public int $failing_hooks,
        public string $icon,
        public string $id,
        public ?string $manage_url,
        public array $project_ids,
        public GitProvider $provider,
        public string $provider_label,
        public StatusData $status,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            account_name: (string) $data['account_name'],
            account_type: (string) $data['account_type'],
            connect_mode: GitConnectMode::from((string) $data['connect_mode']),
            connected_by: $data['connected_by'] === null ? null : (string) $data['connected_by'],
            created_at: (string) $data['created_at'],
            failing_hooks: (int) $data['failing_hooks'],
            icon: (string) $data['icon'],
            id: (string) $data['id'],
            manage_url: $data['manage_url'] === null ? null : (string) $data['manage_url'],
            project_ids: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['project_ids'])),
            provider: GitProvider::from((string) $data['provider']),
            provider_label: (string) $data['provider_label'],
            status: StatusData::fromArray(self::objectValue($data['status'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['account_name'] = $this->account_name;
        $data['account_type'] = $this->account_type;
        $data['connect_mode'] = $this->connect_mode->value;
        $data['connected_by'] = $this->connected_by === null ? null : $this->connected_by;
        $data['created_at'] = $this->created_at;
        $data['failing_hooks'] = $this->failing_hooks;
        $data['icon'] = $this->icon;
        $data['id'] = $this->id;
        $data['manage_url'] = $this->manage_url === null ? null : $this->manage_url;
        $data['project_ids'] = $this->project_ids;
        $data['provider'] = $this->provider->value;
        $data['provider_label'] = $this->provider_label;
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
