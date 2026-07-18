<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsBlockStoragesShowCommand extends GeneratedCommand
{
    protected $signature = 'vented:block-storages:show {project : project path parameter} {storage : storage path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Show block storage overview';

    protected function operationId(): string
    {
        return 'projects.block-storages.show';
    }
}
