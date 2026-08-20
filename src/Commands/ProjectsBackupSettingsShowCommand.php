<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsBackupSettingsShowCommand extends GeneratedCommand
{
    protected $signature = 'vented:backup-settings:show {project : project path parameter} {environment : environment path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Read backup settings';

    protected function operationId(): string
    {
        return 'projects.backup-settings.show';
    }
}
