<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsStackOperationsUpdateCommand extends GeneratedCommand
{
    protected $signature = 'vented:stack-operations:update {project : project path parameter} {environment : environment path parameter} {operation : operation path parameter} {--data= : JSON attributes or @path/to/file.json} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Retry selected resource cleanup';

    protected function operationId(): string
    {
        return 'projects.stack-operations.update';
    }
}
