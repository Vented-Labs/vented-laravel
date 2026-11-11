<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsAppsBindingsRotateCommand extends GeneratedCommand
{
    protected $signature = 'vented:app-bindings:rotate {project : project path parameter} {environment : environment path parameter} {app : app path parameter} {binding : binding path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Rotate an app\'s service credentials';

    protected function operationId(): string
    {
        return 'projects.apps.bindings.rotate';
    }
}
