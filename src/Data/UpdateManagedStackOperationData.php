<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class UpdateManagedStackOperationData
{
    public function __construct(
        public string $status,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            status: (string) $data['status'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['status'] = $this->status;

        return $data;
    }
}
