<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsIntegrationsDestroyCommand extends GeneratedCommand
{
    protected $signature = 'vented:integrations:delete {project : project path parameter} {integration : integration path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response} {--force : Skip destructive operation confirmation}';

    protected $description = 'Delete an integration';

    protected function operationId(): string
    {
        return 'projects.integrations.destroy';
    }
}
