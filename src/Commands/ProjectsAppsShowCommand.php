<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsAppsShowCommand extends GeneratedCommand
{
    protected $signature = 'vented:apps:show {project : project path parameter} {app : app path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Show app overview';

    protected function operationId(): string
    {
        return 'projects.apps.show';
    }
}
