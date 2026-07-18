<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsDeployTriggersDestroyCommand extends GeneratedCommand
{
    protected $signature = 'vented:deploy-triggers:delete {project : project path parameter} {deployTrigger : deployTrigger path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response} {--force : Skip destructive operation confirmation}';

    protected $description = 'Delete a deploy trigger';

    protected function operationId(): string
    {
        return 'projects.deploy-triggers.destroy';
    }
}
