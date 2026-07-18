<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class SelectPlanData
{
    public function __construct(
        public string $plan,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            plan: (string) $data['plan'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['plan'] = $this->plan;

        return $data;
    }
}
