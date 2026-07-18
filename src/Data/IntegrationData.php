<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\GitProvider;
use Vented\Enums\IntegrationType;

final readonly class IntegrationData
{
    public function __construct(
        public string $created_at,
        public bool $enabled,
        public string $id,
        public ?GitProvider $provider,
        public ?IntegrationType $type,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            created_at: (string) $data['created_at'],
            enabled: (bool) $data['enabled'],
            id: (string) $data['id'],
            provider: $data['provider'] === null ? null : GitProvider::from((string) $data['provider']),
            type: $data['type'] === null ? null : IntegrationType::from((string) $data['type']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['created_at'] = $this->created_at;
        $data['enabled'] = $this->enabled;
        $data['id'] = $this->id;
        $data['provider'] = $this->provider === null ? null : $this->provider->value;
        $data['type'] = $this->type === null ? null : $this->type->value;

        return $data;
    }
}
