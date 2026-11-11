<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class TunnelAllowanceData
{
    public function __construct(
        public ?int $limit,
        public int $used,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            limit: $data['limit'] === null ? null : (int) $data['limit'],
            used: (int) $data['used'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['limit'] = $this->limit === null ? null : $this->limit;
        $data['used'] = $this->used;

        return $data;
    }
}
