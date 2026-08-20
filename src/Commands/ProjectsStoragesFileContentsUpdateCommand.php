<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsStoragesFileContentsUpdateCommand extends GeneratedCommand
{
    protected $signature = 'vented:storage-file-contents:update {project : project path parameter} {environment : environment path parameter} {storage : storage path parameter} {file : file path parameter} {--data= : JSON attributes or @path/to/file.json} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Write a file';

    protected function operationId(): string
    {
        return 'projects.storages.file-contents.update';
    }
}
