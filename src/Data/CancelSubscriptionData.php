<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class CancelSubscriptionData
{
    public function __construct(
        public string $operation_key,
        public string $timing,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            operation_key: (string) $data['operation_key'],
            timing: (string) $data['timing'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['operation_key'] = $this->operation_key;
        $data['timing'] = $this->timing;

        return $data;
    }
}
