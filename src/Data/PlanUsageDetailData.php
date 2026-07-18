<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class PlanUsageDetailData
{
    /**
     * @param  list<PlanUsageItemData>  $usage
     */
    public function __construct(
        public int $apps,
        public int $block_storages,
        public string $id,
        public int $members,
        public int $object_storages,
        public int $services,
        public array $usage,
        public int $zones,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            apps: (int) $data['apps'],
            block_storages: (int) $data['block_storages'],
            id: (string) $data['id'],
            members: (int) $data['members'],
            object_storages: (int) $data['object_storages'],
            services: (int) $data['services'],
            usage: array_map(static fn (mixed $value): PlanUsageItemData => PlanUsageItemData::fromArray(self::objectValue($value)), self::listValue($data['usage'])),
            zones: (int) $data['zones'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['apps'] = $this->apps;
        $data['block_storages'] = $this->block_storages;
        $data['id'] = $this->id;
        $data['members'] = $this->members;
        $data['object_storages'] = $this->object_storages;
        $data['services'] = $this->services;
        $data['usage'] = array_map(static fn (PlanUsageItemData $value) => $value->toArray(), $this->usage);
        $data['zones'] = $this->zones;

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
