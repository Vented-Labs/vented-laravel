<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsObjectStoragesShowCommand extends GeneratedCommand
{
    protected $signature = 'vented:object-storages:show {project : project path parameter} {storage : storage path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Show object storage overview';

    protected function operationId(): string
    {
        return 'projects.object-storages.show';
    }
}
