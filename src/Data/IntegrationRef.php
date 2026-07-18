<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\GitProvider;
use Vented\Enums\IntegrationType;

final readonly class IntegrationRef
{
    public function __construct(
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
        $data['id'] = $this->id;
        $data['provider'] = $this->provider === null ? null : $this->provider->value;
        $data['type'] = $this->type === null ? null : $this->type->value;

        return $data;
    }
}
