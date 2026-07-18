<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsBackupSettingsUpdateCommand extends GeneratedCommand
{
    protected $signature = 'vented:backup-settings:update {project : project path parameter} {--data= : JSON attributes or @path/to/file.json} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Update backup settings';

    protected function operationId(): string
    {
        return 'projects.backup-settings.update';
    }
}
