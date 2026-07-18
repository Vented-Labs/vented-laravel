<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsIndexCommand extends GeneratedCommand
{
    protected $signature = 'vented:projects:list {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'List the authenticated user\'s projects';

    protected function operationId(): string
    {
        return 'projects.index';
    }
}
