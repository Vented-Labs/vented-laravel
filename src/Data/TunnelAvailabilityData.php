<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class TunnelAvailabilityData
{
    public function __construct(
        public bool $available,
        public ?string $reason,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            available: (bool) $data['available'],
            reason: $data['reason'] === null ? null : (string) $data['reason'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['available'] = $this->available;
        $data['reason'] = $this->reason === null ? null : $this->reason;

        return $data;
    }
}
