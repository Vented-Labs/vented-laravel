<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsBuildGroupsUpdateCommand extends GeneratedCommand
{
    protected $signature = 'vented:build-groups:update {project : project path parameter} {environment : environment path parameter} {buildGroup : buildGroup path parameter} {--data= : JSON attributes or @path/to/file.json} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Update a build group';

    protected function operationId(): string
    {
        return 'projects.build-groups.update';
    }
}
