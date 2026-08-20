<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsEnvironmentsIndexCommand extends GeneratedCommand
{
    protected $signature = 'vented:environments:list {project : project path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'List project environments';

    protected function operationId(): string
    {
        return 'projects.environments.index';
    }
}
