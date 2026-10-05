<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class PlanData
{
    /**
     * @param  list<PlanUsageItemData>  $usage
     */
    public function __construct(
        public int $apps,
        public int $backups,
        public ?PlanCatalogData $catalog,
        public int $environments,
        public string $id,
        public int $members,
        public ?string $plan,
        public ?PlanSampleUsageData $sample_usage,
        public int $services,
        public int $storages,
        public array $usage,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            apps: (int) $data['apps'],
            backups: (int) $data['backups'],
            catalog: $data['catalog'] === null ? null : PlanCatalogData::fromArray(self::objectValue($data['catalog'])),
            environments: (int) $data['environments'],
            id: (string) $data['id'],
            members: (int) $data['members'],
            plan: $data['plan'] === null ? null : (string) $data['plan'],
            sample_usage: $data['sample_usage'] === null ? null : PlanSampleUsageData::fromArray(self::objectValue($data['sample_usage'])),
            services: (int) $data['services'],
            storages: (int) $data['storages'],
            usage: array_map(static fn (mixed $value): PlanUsageItemData => PlanUsageItemData::fromArray(self::objectValue($value)), self::listValue($data['usage'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['apps'] = $this->apps;
        $data['backups'] = $this->backups;
        $data['catalog'] = $this->catalog === null ? null : $this->catalog->toArray();
        $data['environments'] = $this->environments;
        $data['id'] = $this->id;
        $data['members'] = $this->members;
        $data['plan'] = $this->plan === null ? null : $this->plan;
        $data['sample_usage'] = $this->sample_usage === null ? null : $this->sample_usage->toArray();
        $data['services'] = $this->services;
        $data['storages'] = $this->storages;
        $data['usage'] = array_map(static fn (PlanUsageItemData $value) => $value->toArray(), $this->usage);

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
