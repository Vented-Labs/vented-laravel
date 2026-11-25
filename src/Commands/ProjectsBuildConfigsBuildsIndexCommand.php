<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsBuildConfigsBuildsIndexCommand extends GeneratedCommand
{
    protected $signature = 'vented:build-config-builds:list {project : project path parameter} {environment : environment path parameter} {buildConfig : buildConfig path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'List a build configuration\'s builds';

    protected function operationId(): string
    {
        return 'projects.build-configs.builds.index';
    }
}
