<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsStoreCommand extends GeneratedCommand
{
    protected $signature = 'vented:projects:create {--data= : JSON attributes or @path/to/file.json} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Create a new project';

    protected function operationId(): string
    {
        return 'projects.store';
    }
}
