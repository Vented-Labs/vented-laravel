<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsStoragesFilesIndexCommand extends GeneratedCommand
{
    protected $signature = 'vented:storage-files:list {project : project path parameter} {storage : storage path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'List files in a storage directory';

    protected function operationId(): string
    {
        return 'projects.storages.files.index';
    }
}
