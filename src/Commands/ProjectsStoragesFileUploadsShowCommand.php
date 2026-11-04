<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsStoragesFileUploadsShowCommand extends GeneratedCommand
{
    protected $signature = 'vented:storage-file-uploads:show {project : project path parameter} {environment : environment path parameter} {storage : storage path parameter} {upload : upload path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Show an upload in parts';

    protected function operationId(): string
    {
        return 'projects.storages.file-uploads.show';
    }
}
