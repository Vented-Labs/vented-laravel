<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsDnsZonesBindingsDestroyCommand extends GeneratedCommand
{
    protected $signature = 'vented:dns-zone-bindings:delete {project : project path parameter} {zone : zone path parameter} {binding : binding path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response} {--force : Skip destructive operation confirmation}';

    protected $description = 'Delete an app binding';

    protected function operationId(): string
    {
        return 'projects.dns.zones.bindings.destroy';
    }
}
