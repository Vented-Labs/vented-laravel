<?php

declare(strict_types=1);

namespace Vented\Data;

final readonly class PlanLimitsData
{
    public function __construct(
        public int $apps,
        public int $backup_retention_days,
        public int $backups_per_day,
        public int $cpu_millicores,
        public int $disk_bytes,
        public ?int $emails_per_day,
        public int $environments,
        public int $memory_bytes,
        public int $transfer_bytes,
        public int $tunnels,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            apps: (int) $data['apps'],
            backup_retention_days: (int) $data['backup_retention_days'],
            backups_per_day: (int) $data['backups_per_day'],
            cpu_millicores: (int) $data['cpu_millicores'],
            disk_bytes: (int) $data['disk_bytes'],
            emails_per_day: $data['emails_per_day'] === null ? null : (int) $data['emails_per_day'],
            environments: (int) $data['environments'],
            memory_bytes: (int) $data['memory_bytes'],
            transfer_bytes: (int) $data['transfer_bytes'],
            tunnels: (int) $data['tunnels'],
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $data = [];
        $data['apps'] = $this->apps;
        $data['backup_retention_days'] = $this->backup_retention_days;
        $data['backups_per_day'] = $this->backups_per_day;
        $data['cpu_millicores'] = $this->cpu_millicores;
        $data['disk_bytes'] = $this->disk_bytes;
        $data['emails_per_day'] = $this->emails_per_day === null ? null : $this->emails_per_day;
        $data['environments'] = $this->environments;
        $data['memory_bytes'] = $this->memory_bytes;
        $data['transfer_bytes'] = $this->transfer_bytes;
        $data['tunnels'] = $this->tunnels;

        return $data;
    }
}
