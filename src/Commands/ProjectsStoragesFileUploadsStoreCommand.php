<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsStoragesFileUploadsStoreCommand extends GeneratedCommand
{
    protected $signature = 'vented:storage-file-uploads:create {project : project path parameter} {environment : environment path parameter} {storage : storage path parameter} {--data= : JSON attributes or @path/to/file.json} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Start an upload in parts';

    protected function operationId(): string
    {
        return 'projects.storages.file-uploads.store';
    }
}
