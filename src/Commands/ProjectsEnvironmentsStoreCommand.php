<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsEnvironmentsStoreCommand extends GeneratedCommand
{
    protected $signature = 'vented:environments:create {project : project path parameter} {--data= : JSON attributes or @path/to/file.json} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Create an environment';

    protected function operationId(): string
    {
        return 'projects.environments.store';
    }
}
