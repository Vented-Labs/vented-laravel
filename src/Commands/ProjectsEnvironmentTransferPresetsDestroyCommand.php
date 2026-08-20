<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsEnvironmentTransferPresetsDestroyCommand extends GeneratedCommand
{
    protected $signature = 'vented:environment-transfer-presets:delete {project : project path parameter} {environment : environment path parameter} {transferPreset : transferPreset path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response} {--force : Skip destructive operation confirmation}';

    protected $description = 'Delete an environment transfer preset';

    protected function operationId(): string
    {
        return 'projects.environment-transfer-presets.destroy';
    }
}
