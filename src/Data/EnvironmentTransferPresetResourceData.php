<?php

declare(strict_types=1);

namespace Vented\Data;

use Vented\Enums\EnvironmentTransferResourceType;

final readonly class EnvironmentTransferPresetResourceData
{
    public function __construct(
        public string $source_resource_id,
        public EnvironmentTransferResourceType $type,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            source_resource_id: (string) $data['source_resource_id'],
            type: EnvironmentTransferResourceType::from((string) $data['type']),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['source_resource_id'] = $this->source_resource_id;
        $data['type'] = $this->type->value;

        return $data;
    }
}
