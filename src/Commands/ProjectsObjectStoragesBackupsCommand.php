<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsObjectStoragesBackupsCommand extends GeneratedCommand
{
    protected $signature = 'vented:object-storage-backups:list {project : project path parameter} {environment : environment path parameter} {storage : storage path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'List backups stored on this bucket';

    protected function operationId(): string
    {
        return 'projects.object-storages.backups';
    }
}
