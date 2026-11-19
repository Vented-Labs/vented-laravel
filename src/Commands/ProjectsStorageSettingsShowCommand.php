<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsStorageSettingsShowCommand extends GeneratedCommand
{
    protected $signature = 'vented:storage-settings:show {project : project path parameter} {environment : environment path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Read storage settings';

    protected function operationId(): string
    {
        return 'projects.storage-settings.show';
    }
}
