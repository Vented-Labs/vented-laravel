<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class ManagedStackOverviewData
{
    /**
     * @param  list<AppData>  $apps
     * @param  list<DeployData>  $recent_deploys
     * @param  list<ServiceData>  $services
     * @param  list<BlockStorageData>  $storages
     */
    public function __construct(
        public array $apps,
        public SoftwareInventoryData $inventory,
        public array $recent_deploys,
        public array $services,
        public array $storages,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            apps: array_map(static fn (mixed $value): AppData => AppData::fromArray(self::objectValue($value)), self::listValue($data['apps'])),
            inventory: SoftwareInventoryData::fromArray(self::objectValue($data['inventory'])),
            recent_deploys: array_map(static fn (mixed $value): DeployData => DeployData::fromArray(self::objectValue($value)), self::listValue($data['recent_deploys'])),
            services: array_map(static fn (mixed $value): ServiceData => ServiceData::fromArray(self::objectValue($value)), self::listValue($data['services'])),
            storages: array_map(static fn (mixed $value): BlockStorageData => BlockStorageData::fromArray(self::objectValue($value)), self::listValue($data['storages'])),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['apps'] = array_map(static fn (AppData $value) => $value->toArray(), $this->apps);
        $data['inventory'] = $this->inventory->toArray();
        $data['recent_deploys'] = array_map(static fn (DeployData $value) => $value->toArray(), $this->recent_deploys);
        $data['services'] = array_map(static fn (ServiceData $value) => $value->toArray(), $this->services);
        $data['storages'] = array_map(static fn (BlockStorageData $value) => $value->toArray(), $this->storages);

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
