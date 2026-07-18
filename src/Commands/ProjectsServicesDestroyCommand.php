<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsServicesDestroyCommand extends GeneratedCommand
{
    protected $signature = 'vented:services:delete {project : project path parameter} {service : service path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response} {--force : Skip destructive operation confirmation}';

    protected $description = 'Remove a service';

    protected function operationId(): string
    {
        return 'projects.services.destroy';
    }
}
