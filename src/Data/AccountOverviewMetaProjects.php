<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class AccountOverviewMetaProjects
{
    public function __construct(
        public int $app_count,
        public int $project_count,
        public int $service_count,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            app_count: (int) $data['app_count'],
            project_count: (int) $data['project_count'],
            service_count: (int) $data['service_count'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['app_count'] = $this->app_count;
        $data['project_count'] = $this->project_count;
        $data['service_count'] = $this->service_count;

        return $data;
    }
}
