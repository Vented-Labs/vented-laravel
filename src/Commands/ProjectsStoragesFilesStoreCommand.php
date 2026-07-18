<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsStoragesFilesStoreCommand extends GeneratedCommand
{
    protected $signature = 'vented:storage-files:create {project : project path parameter} {storage : storage path parameter} {--data= : JSON attributes or @path/to/file.json} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Create files or a directory in a storage';

    protected function operationId(): string
    {
        return 'projects.storages.files.store';
    }
}
