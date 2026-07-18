<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsIntegrationsStoreCommand extends GeneratedCommand
{
    protected $signature = 'vented:integrations:create {project : project path parameter} {--data= : JSON attributes or @path/to/file.json} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Create an integration';

    protected function operationId(): string
    {
        return 'projects.integrations.store';
    }
}
