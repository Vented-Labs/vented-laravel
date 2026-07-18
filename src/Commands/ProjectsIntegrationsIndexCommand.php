<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsIntegrationsIndexCommand extends GeneratedCommand
{
    protected $signature = 'vented:integrations:list {project : project path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'List integrations for a project';

    protected function operationId(): string
    {
        return 'projects.integrations.index';
    }
}
