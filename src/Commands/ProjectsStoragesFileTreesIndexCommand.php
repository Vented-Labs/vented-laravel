<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsStoragesFileTreesIndexCommand extends GeneratedCommand
{
    protected $signature = 'vented:storage-file-trees:list {project : project path parameter} {environment : environment path parameter} {storage : storage path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'List everything below a folder';

    protected function operationId(): string
    {
        return 'projects.storages.file-trees.index';
    }
}
