<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsAppsBindingsDestroyCommand extends GeneratedCommand
{
    protected $signature = 'vented:app-bindings:delete {project : project path parameter} {app : app path parameter} {binding : binding path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response} {--force : Skip destructive operation confirmation}';

    protected $description = 'Delete a binding from an app';

    protected function operationId(): string
    {
        return 'projects.apps.bindings.destroy';
    }
}
