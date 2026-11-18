<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsBuildGroupsStoreCommand extends GeneratedCommand
{
    protected $signature = 'vented:build-groups:create {project : project path parameter} {environment : environment path parameter} {--data= : JSON attributes or @path/to/file.json} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Create a build group';

    protected function operationId(): string
    {
        return 'projects.build-groups.store';
    }
}
