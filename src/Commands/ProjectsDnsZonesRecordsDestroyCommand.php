<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsDnsZonesRecordsDestroyCommand extends GeneratedCommand
{
    protected $signature = 'vented:dns-zone-records:delete {project : project path parameter} {zone : zone path parameter} {record : record path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response} {--force : Skip destructive operation confirmation}';

    protected $description = 'Delete a DNS record';

    protected function operationId(): string
    {
        return 'projects.dns.zones.records.destroy';
    }
}
