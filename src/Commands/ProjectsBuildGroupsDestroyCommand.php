<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsBuildGroupsDestroyCommand extends GeneratedCommand
{
    protected $signature = 'vented:build-groups:delete {project : project path parameter} {environment : environment path parameter} {buildGroup : buildGroup path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response} {--force : Skip destructive operation confirmation}';

    protected $description = 'Ungroup build configurations';

    protected function operationId(): string
    {
        return 'projects.build-groups.destroy';
    }
}
