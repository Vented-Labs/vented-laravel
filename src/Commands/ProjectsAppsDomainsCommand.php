<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsAppsDomainsCommand extends GeneratedCommand
{
    protected $signature = 'vented:app-domains:list {project : project path parameter} {app : app path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'List app bindings for an app';

    protected function operationId(): string
    {
        return 'projects.apps.domains';
    }
}
