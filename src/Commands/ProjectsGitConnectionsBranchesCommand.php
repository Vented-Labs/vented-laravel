<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsGitConnectionsBranchesCommand extends GeneratedCommand
{
    protected $signature = 'vented:git-connection-branches:list {project : project path parameter} {gitConnection : gitConnection path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'List a repository\'s branches';

    protected function operationId(): string
    {
        return 'projects.git-connections.branches';
    }
}
