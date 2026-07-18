<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsDnsZonesDestroyCommand extends GeneratedCommand
{
    protected $signature = 'vented:dns-zones:delete {project : project path parameter} {zone : zone path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response} {--force : Skip destructive operation confirmation}';

    protected $description = 'Delete a DNS zone';

    protected function operationId(): string
    {
        return 'projects.dns.zones.destroy';
    }
}
