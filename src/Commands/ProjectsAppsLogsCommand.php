<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsAppsLogsCommand extends GeneratedCommand
{
    protected $signature = 'vented:app-logs:list {project : project path parameter} {environment : environment path parameter} {app : app path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'List app output';

    protected function operationId(): string
    {
        return 'projects.apps.logs';
    }
}
