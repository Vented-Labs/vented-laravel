<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsEnvironmentsShowCommand extends GeneratedCommand
{
    protected $signature = 'vented:environments:show {project : project path parameter} {environment : environment path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Show an environment';

    protected function operationId(): string
    {
        return 'projects.environments.show';
    }
}
