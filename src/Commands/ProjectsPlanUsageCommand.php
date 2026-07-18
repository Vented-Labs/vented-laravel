<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsPlanUsageCommand extends GeneratedCommand
{
    protected $signature = 'vented:plan:usage {project : project path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Project plan usage detail';

    protected function operationId(): string
    {
        return 'projects.plan.usage';
    }
}
