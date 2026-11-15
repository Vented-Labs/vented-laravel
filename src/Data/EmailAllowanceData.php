<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class EmailAllowanceData
{
    public function __construct(
        public int $allowance,
        public int $limit,
        public string $meter,
        public int $monthly_pool,
        public ?string $monthly_pool_expires_at,
        public int $monthly_pool_remaining,
        public int $packs_remaining,
        public string $period,
        public ?int $sent,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            allowance: (int) $data['allowance'],
            limit: (int) $data['limit'],
            meter: (string) $data['meter'],
            monthly_pool: (int) $data['monthly_pool'],
            monthly_pool_expires_at: $data['monthly_pool_expires_at'] === null ? null : (string) $data['monthly_pool_expires_at'],
            monthly_pool_remaining: (int) $data['monthly_pool_remaining'],
            packs_remaining: (int) $data['packs_remaining'],
            period: (string) $data['period'],
            sent: $data['sent'] === null ? null : (int) $data['sent'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['allowance'] = $this->allowance;
        $data['limit'] = $this->limit;
        $data['meter'] = $this->meter;
        $data['monthly_pool'] = $this->monthly_pool;
        $data['monthly_pool_expires_at'] = $this->monthly_pool_expires_at === null ? null : $this->monthly_pool_expires_at;
        $data['monthly_pool_remaining'] = $this->monthly_pool_remaining;
        $data['packs_remaining'] = $this->packs_remaining;
        $data['period'] = $this->period;
        $data['sent'] = $this->sent === null ? null : $this->sent;

        return $data;
    }
}
