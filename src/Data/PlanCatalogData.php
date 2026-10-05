<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class PlanCatalogData
{
    /**
     * @param  list<PlanCatalogExtraData>  $extras
     * @param  list<string>  $gates
     * @param  list<string>  $includes
     * @param  list<PlanCatalogTierData>  $plans
     */
    public function __construct(
        public array $extras,
        public array $gates,
        public PlanCatalogTierData $hobby,
        public array $includes,
        public array $plans,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            extras: array_map(static fn (mixed $value): PlanCatalogExtraData => PlanCatalogExtraData::fromArray(self::objectValue($value)), self::listValue($data['extras'])),
            gates: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['gates'])),
            hobby: PlanCatalogTierData::fromArray(self::objectValue($data['hobby'])),
            includes: array_map(static fn (mixed $value): string => (string) $value, self::listValue($data['includes'])),
            plans: array_map(static fn (mixed $value): PlanCatalogTierData => PlanCatalogTierData::fromArray(self::objectValue($value)), self::listValue($data['plans'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['extras'] = array_map(static fn (PlanCatalogExtraData $value) => $value->toArray(), $this->extras);
        $data['gates'] = $this->gates;
        $data['hobby'] = $this->hobby->toArray();
        $data['includes'] = $this->includes;
        $data['plans'] = array_map(static fn (PlanCatalogTierData $value) => $value->toArray(), $this->plans);

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
