<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsDeploysIndexCommand extends GeneratedCommand
{
    protected $signature = 'vented:deploys:list {project : project path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'List deploys for a project';

    protected function operationId(): string
    {
        return 'projects.deploys.index';
    }
}
