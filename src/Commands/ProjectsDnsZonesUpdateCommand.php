<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsDnsZonesUpdateCommand extends GeneratedCommand
{
    protected $signature = 'vented:dns-zones:update {project : project path parameter} {zone : zone path parameter} {--data= : JSON attributes or @path/to/file.json} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Update a DNS zone';

    protected function operationId(): string
    {
        return 'projects.dns.zones.update';
    }
}
