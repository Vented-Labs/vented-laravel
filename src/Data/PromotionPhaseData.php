<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class PromotionPhaseData
{
    public function __construct(
        public ?int $amount_off,
        public bool $current,
        public ?string $ends_at,
        public ?int $months,
        public ?float $percent_off,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            amount_off: $data['amount_off'] === null ? null : (int) $data['amount_off'],
            current: (bool) $data['current'],
            ends_at: $data['ends_at'] === null ? null : (string) $data['ends_at'],
            months: $data['months'] === null ? null : (int) $data['months'],
            percent_off: $data['percent_off'] === null ? null : (float) $data['percent_off'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['amount_off'] = $this->amount_off === null ? null : $this->amount_off;
        $data['current'] = $this->current;
        $data['ends_at'] = $this->ends_at === null ? null : $this->ends_at;
        $data['months'] = $this->months === null ? null : $this->months;
        $data['percent_off'] = $this->percent_off === null ? null : $this->percent_off;

        return $data;
    }
}
