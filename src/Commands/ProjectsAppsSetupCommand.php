<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsAppsSetupCommand extends GeneratedCommand
{
    protected $signature = 'vented:apps:setup {project : project path parameter} {environment : environment path parameter} {app : app path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Show app installation credentials';

    protected function operationId(): string
    {
        return 'projects.apps.setup';
    }
}
