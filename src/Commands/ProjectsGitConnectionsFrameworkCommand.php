<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsGitConnectionsFrameworkCommand extends GeneratedCommand
{
    protected $signature = 'vented:git-connections:framework {project : project path parameter} {gitConnection : gitConnection path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Detect a repository\'s framework';

    protected function operationId(): string
    {
        return 'projects.git-connections.framework';
    }
}
