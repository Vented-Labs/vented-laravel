<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsPinStoreCommand extends GeneratedCommand
{
    protected $signature = 'vented:project-pins:create {project : project path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Pin a project';

    protected function operationId(): string
    {
        return 'projects.pin.store';
    }
}
