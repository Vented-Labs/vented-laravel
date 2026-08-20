<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsAppsDestroyCommand extends GeneratedCommand
{
    protected $signature = 'vented:apps:delete {project : project path parameter} {environment : environment path parameter} {app : app path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response} {--force : Skip destructive operation confirmation}';

    protected $description = 'Delete an app';

    protected function operationId(): string
    {
        return 'projects.apps.destroy';
    }
}
