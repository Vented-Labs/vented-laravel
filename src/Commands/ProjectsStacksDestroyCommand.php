<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsStacksDestroyCommand extends GeneratedCommand
{
    protected $signature = 'vented:stacks:delete {project : project path parameter} {environment : environment path parameter} {stack : stack path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response} {--force : Skip destructive operation confirmation}';

    protected $description = 'Unlink a managed stack';

    protected function operationId(): string
    {
        return 'projects.stacks.destroy';
    }
}
