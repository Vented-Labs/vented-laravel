<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class DeveloperOverviewData
{
    public function __construct(
        public int $cron_job_count,
        public int $git_integration_count,
        public int $integration_count,
        public string $project_id,
        public int $ssh_key_count,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            cron_job_count: (int) $data['cron_job_count'],
            git_integration_count: (int) $data['git_integration_count'],
            integration_count: (int) $data['integration_count'],
            project_id: (string) $data['project_id'],
            ssh_key_count: (int) $data['ssh_key_count'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['cron_job_count'] = $this->cron_job_count;
        $data['git_integration_count'] = $this->git_integration_count;
        $data['integration_count'] = $this->integration_count;
        $data['project_id'] = $this->project_id;
        $data['ssh_key_count'] = $this->ssh_key_count;

        return $data;
    }
}
