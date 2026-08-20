<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsStoragesFilesDestroyCommand extends GeneratedCommand
{
    protected $signature = 'vented:storage-files:delete {project : project path parameter} {environment : environment path parameter} {storage : storage path parameter} {file : file path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response} {--force : Skip destructive operation confirmation}';

    protected $description = 'Delete a file or directory';

    protected function operationId(): string
    {
        return 'projects.storages.files.destroy';
    }
}
