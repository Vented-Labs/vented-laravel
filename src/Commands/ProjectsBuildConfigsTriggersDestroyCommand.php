<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsBuildConfigsTriggersDestroyCommand extends GeneratedCommand
{
    protected $signature = 'vented:build-config-triggers:delete {project : project path parameter} {environment : environment path parameter} {buildConfig : buildConfig path parameter} {deployTrigger : deployTrigger path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response} {--force : Skip destructive operation confirmation}';

    protected $description = 'Delete a build configuration trigger';

    protected function operationId(): string
    {
        return 'projects.build-configs.triggers.destroy';
    }
}
