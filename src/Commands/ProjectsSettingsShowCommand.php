<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsSettingsShowCommand extends GeneratedCommand
{
    protected $signature = 'vented:settings:show {project : project path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Show project settings';

    protected function operationId(): string
    {
        return 'projects.settings.show';
    }
}
