<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class OverviewShowMetaStats
{
    public function __construct(
        public int $apps,
        public int $members,
        public int $services,
        public int $storages,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            apps: (int) $data['apps'],
            members: (int) $data['members'],
            services: (int) $data['services'],
            storages: (int) $data['storages'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['apps'] = $this->apps;
        $data['members'] = $this->members;
        $data['services'] = $this->services;
        $data['storages'] = $this->storages;

        return $data;
    }
}
