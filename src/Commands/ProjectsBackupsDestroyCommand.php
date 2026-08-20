<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsBackupsDestroyCommand extends GeneratedCommand
{
    protected $signature = 'vented:backups:delete {project : project path parameter} {environment : environment path parameter} {backup : backup path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response} {--force : Skip destructive operation confirmation}';

    protected $description = 'Delete a backup';

    protected function operationId(): string
    {
        return 'projects.backups.destroy';
    }
}
