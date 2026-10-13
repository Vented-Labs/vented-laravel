<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class PromotionBenefitData
{
    /**
     * @param  list<PromotionPhaseData>  $phases
     * @param  list<string>  $products
     */
    public function __construct(
        public bool $active,
        public string $code,
        public ?string $description,
        public ?string $end_reason,
        public ?string $ended_at,
        public ?string $ends_at,
        public string $id,
        public string $name,
        public array $phases,
        public array $products,
        public ?string $starts_at,
        public StatusData $status,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            active: (bool) $data['active'],
            code: (string) $data['code'],
            description: $data['description'] === null ? null : (string) $data['description'],
            end_reason: $data['end_reason'] === null ? null : (string) $data['end_reason'],
            ended_at: $data['ended_at'] === null ? null : (string) $data['ended_at'],
            ends_at: $data['ends_at'] === null ? null : (string) $data['ends_at'],
            id: (string) $data['id'],
            name: (string) $data['name'],
            phases: array_map(static fn (mixed $value): PromotionPhaseData => PromotionPhaseData::fromArray(self::objectValue($value)), self::listValue($data['phases'])),
            products: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['products'])),
            starts_at: $data['starts_at'] === null ? null : (string) $data['starts_at'],
            status: StatusData::fromArray(self::objectValue($data['status'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['active'] = $this->active;
        $data['code'] = $this->code;
        $data['description'] = $this->description === null ? null : $this->description;
        $data['end_reason'] = $this->end_reason === null ? null : $this->end_reason;
        $data['ended_at'] = $this->ended_at === null ? null : $this->ended_at;
        $data['ends_at'] = $this->ends_at === null ? null : $this->ends_at;
        $data['id'] = $this->id;
        $data['name'] = $this->name;
        $data['phases'] = array_map(static fn (PromotionPhaseData $value) => $value->toArray(), $this->phases);
        $data['products'] = $this->products;
        $data['starts_at'] = $this->starts_at === null ? null : $this->starts_at;
        $data['status'] = $this->status->toArray();

        return $data;
    }

    /**
     * @return array<string, mixed>
     */
    private static function objectValue(mixed $value): array
    {
        if (! is_array($value)) {
            throw new \InvalidArgumentException('Expected an object value.');
        }

        /** @var array<string, mixed> $value */
        return $value;
    }

    /**
     * @return list<mixed>
     */
    private static function listValue(mixed $value): array
    {
        if (! is_array($value)) {
            throw new \InvalidArgumentException('Expected an array value.');
        }

        return array_values($value);
    }
}
