<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsAppsStoreCommand extends GeneratedCommand
{
    protected $signature = 'vented:apps:create {project : project path parameter} {--data= : JSON attributes or @path/to/file.json} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Deploy a new app';

    protected function operationId(): string
    {
        return 'projects.apps.store';
    }
}
