<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsStoragesFileContentsShowCommand extends GeneratedCommand
{
    protected $signature = 'vented:storage-file-contents:show {project : project path parameter} {storage : storage path parameter} {file : file path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Read a file';

    protected function operationId(): string
    {
        return 'projects.storages.file-contents.show';
    }
}
