<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsAppsUpdateCommand extends GeneratedCommand
{
    protected $signature = 'vented:apps:update {project : project path parameter} {environment : environment path parameter} {app : app path parameter} {--data= : JSON attributes or @path/to/file.json} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Update app configuration';

    protected function operationId(): string
    {
        return 'projects.apps.update';
    }
}
