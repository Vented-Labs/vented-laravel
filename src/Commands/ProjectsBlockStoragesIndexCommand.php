<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsBlockStoragesIndexCommand extends GeneratedCommand
{
    protected $signature = 'vented:block-storages:list {project : project path parameter} {environment : environment path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'List block storage volumes for an environment';

    protected function operationId(): string
    {
        return 'projects.block-storages.index';
    }
}
