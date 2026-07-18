<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsDnsZonesIndexCommand extends GeneratedCommand
{
    protected $signature = 'vented:dns-zones:list {project : project path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'List DNS zones for a project';

    protected function operationId(): string
    {
        return 'projects.dns.zones.index';
    }
}
