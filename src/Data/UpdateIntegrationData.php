<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\OptionalValue;

final readonly class UpdateIntegrationData
{
    public function __construct(
        public bool|OptionalValue $enabled = OptionalValue::Missing,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            enabled: array_key_exists('enabled', $data) ? (bool) $data['enabled'] : OptionalValue::Missing,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        if ($this->enabled !== OptionalValue::Missing) {
            $data['enabled'] = $this->enabled;
        }

        return $data;
    }
}
