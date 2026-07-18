<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsPlanShowCommand extends GeneratedCommand
{
    protected $signature = 'vented:plan:show {project : project path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Show a project\'s plan & usage summary';

    protected function operationId(): string
    {
        return 'projects.plan.show';
    }
}
