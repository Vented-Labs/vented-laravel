<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsOverviewCommand extends GeneratedCommand
{
    protected $signature = 'vented:projects:show {project : project path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Show a single project';

    protected function operationId(): string
    {
        return 'projects.overview';
    }
}
