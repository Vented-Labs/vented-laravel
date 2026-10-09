<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsStacksUpdateCommand extends GeneratedCommand
{
    protected $signature = 'vented:stacks:update {project : project path parameter} {environment : environment path parameter} {stack : stack path parameter} {--data= : JSON attributes or @path/to/file.json} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Update a managed stack';

    protected function operationId(): string
    {
        return 'projects.stacks.update';
    }
}
