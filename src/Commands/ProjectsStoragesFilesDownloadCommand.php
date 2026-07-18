<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsStoragesFilesDownloadCommand extends GeneratedCommand
{
    protected $signature = 'vented:storage-files:download {project : project path parameter} {storage : storage path parameter} {file : file path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response} {--output= : Destination path, or - for stdout}';

    protected $description = 'Download a file';

    protected function operationId(): string
    {
        return 'projects.storages.files.download';
    }
}
