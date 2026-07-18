<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\IntegrationType;

final readonly class StoreIntegrationData
{
    public function __construct(
        public string $access_token,
        public string $provider,
        public IntegrationType $type,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            access_token: (string) $data['access_token'],
            provider: (string) $data['provider'],
            type: IntegrationType::from((string) $data['type']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['access_token'] = $this->access_token;
        $data['provider'] = $this->provider;
        $data['type'] = $this->type->value;

        return $data;
    }
}
