<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsAppsRestartCommand extends GeneratedCommand
{
    protected $signature = 'vented:apps:restart {project : project path parameter} {environment : environment path parameter} {app : app path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Restart an app';

    protected function operationId(): string
    {
        return 'projects.apps.restart';
    }
}
