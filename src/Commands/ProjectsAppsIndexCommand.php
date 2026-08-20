<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsAppsIndexCommand extends GeneratedCommand
{
    protected $signature = 'vented:apps:list {project : project path parameter} {environment : environment path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'List apps for an environment';

    protected function operationId(): string
    {
        return 'projects.apps.index';
    }
}
