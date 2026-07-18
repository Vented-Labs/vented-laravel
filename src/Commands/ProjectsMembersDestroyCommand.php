<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsMembersDestroyCommand extends GeneratedCommand
{
    protected $signature = 'vented:members:delete {project : project path parameter} {member : member path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response} {--force : Skip destructive operation confirmation}';

    protected $description = 'Remove a member from the project';

    protected function operationId(): string
    {
        return 'projects.members.destroy';
    }
}
