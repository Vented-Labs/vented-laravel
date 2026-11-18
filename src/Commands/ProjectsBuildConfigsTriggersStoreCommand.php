<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsBuildConfigsTriggersStoreCommand extends GeneratedCommand
{
    protected $signature = 'vented:build-config-triggers:create {project : project path parameter} {environment : environment path parameter} {buildConfig : buildConfig path parameter} {--data= : JSON attributes or @path/to/file.json} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Create a build configuration trigger';

    protected function operationId(): string
    {
        return 'projects.build-configs.triggers.store';
    }
}
