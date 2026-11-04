<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsStoragesFilesShowCommand extends GeneratedCommand
{
    protected $signature = 'vented:storage-files:show {project : project path parameter} {environment : environment path parameter} {storage : storage path parameter} {file : file path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Show a file or folder';

    protected function operationId(): string
    {
        return 'projects.storages.files.show';
    }
}
