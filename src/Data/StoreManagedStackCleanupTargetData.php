<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class StoreManagedStackCleanupTargetData
{
    public function __construct(
        public string $kind,
        public string $resource_id,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            kind: (string) $data['kind'],
            resource_id: (string) $data['resource_id'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['kind'] = $this->kind;
        $data['resource_id'] = $this->resource_id;

        return $data;
    }
}
