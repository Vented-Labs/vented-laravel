<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsObjectStoragesDestroyCommand extends GeneratedCommand
{
    protected $signature = 'vented:object-storages:delete {project : project path parameter} {storage : storage path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response} {--force : Skip destructive operation confirmation}';

    protected $description = 'Delete an object storage bucket';

    protected function operationId(): string
    {
        return 'projects.object-storages.destroy';
    }
}
