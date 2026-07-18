<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsPlanUpdateCommand extends GeneratedCommand
{
    protected $signature = 'vented:plan:update {project : project path parameter} {--data= : JSON attributes or @path/to/file.json} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Select a plan';

    protected function operationId(): string
    {
        return 'projects.plan.update';
    }
}
