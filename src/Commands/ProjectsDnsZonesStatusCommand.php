<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsDnsZonesStatusCommand extends GeneratedCommand
{
    protected $signature = 'vented:dns-zones:status {project : project path parameter} {zone : zone path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Check live DNS status for a zone';

    protected function operationId(): string
    {
        return 'projects.dns.zones.status';
    }
}
