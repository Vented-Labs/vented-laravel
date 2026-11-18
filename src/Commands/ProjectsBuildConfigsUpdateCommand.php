<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsBuildConfigsUpdateCommand extends GeneratedCommand
{
    protected $signature = 'vented:build-configs:update {project : project path parameter} {environment : environment path parameter} {buildConfig : buildConfig path parameter} {--data= : JSON attributes or @path/to/file.json} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Update a build configuration';

    protected function operationId(): string
    {
        return 'projects.build-configs.update';
    }
}
