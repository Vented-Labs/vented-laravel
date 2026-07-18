<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsDnsZonesShowCommand extends GeneratedCommand
{
    protected $signature = 'vented:dns-zones:show {project : project path parameter} {zone : zone path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Show a DNS zone';

    protected function operationId(): string
    {
        return 'projects.dns.zones.show';
    }
}
