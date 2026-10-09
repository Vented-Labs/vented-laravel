<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsStacksShowCommand extends GeneratedCommand
{
    protected $signature = 'vented:stacks:show {project : project path parameter} {environment : environment path parameter} {stack : stack path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'View a managed stack';

    protected function operationId(): string
    {
        return 'projects.stacks.show';
    }
}
