<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsAppsConfigurationCommand extends GeneratedCommand
{
    protected $signature = 'vented:apps:configuration {project : project path parameter} {environment : environment path parameter} {app : app path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Show app configuration';

    protected function operationId(): string
    {
        return 'projects.apps.configuration';
    }
}
