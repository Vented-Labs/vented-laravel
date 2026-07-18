<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsDnsZonesBindingsUpdateCommand extends GeneratedCommand
{
    protected $signature = 'vented:dns-zone-bindings:update {project : project path parameter} {zone : zone path parameter} {binding : binding path parameter} {--data= : JSON attributes or @path/to/file.json} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Update an app binding';

    protected function operationId(): string
    {
        return 'projects.dns.zones.bindings.update';
    }
}
