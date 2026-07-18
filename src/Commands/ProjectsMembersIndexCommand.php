<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsMembersIndexCommand extends GeneratedCommand
{
    protected $signature = 'vented:members:list {project : project path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'List project members';

    protected function operationId(): string
    {
        return 'projects.members.index';
    }
}
