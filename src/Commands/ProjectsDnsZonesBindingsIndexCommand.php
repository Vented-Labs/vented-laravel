<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsDnsZonesBindingsIndexCommand extends GeneratedCommand
{
    protected $signature = 'vented:dns-zone-bindings:list {project : project path parameter} {zone : zone path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'List app bindings for a zone';

    protected function operationId(): string
    {
        return 'projects.dns.zones.bindings.index';
    }
}
