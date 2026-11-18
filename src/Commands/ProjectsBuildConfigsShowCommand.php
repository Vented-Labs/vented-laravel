<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsBuildConfigsShowCommand extends GeneratedCommand
{
    protected $signature = 'vented:build-configs:show {project : project path parameter} {environment : environment path parameter} {buildConfig : buildConfig path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Show a build configuration';

    protected function operationId(): string
    {
        return 'projects.build-configs.show';
    }
}
