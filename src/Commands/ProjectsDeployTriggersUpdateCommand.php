<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsDeployTriggersUpdateCommand extends GeneratedCommand
{
    protected $signature = 'vented:deploy-triggers:update {project : project path parameter} {deployTrigger : deployTrigger path parameter} {--data= : JSON attributes or @path/to/file.json} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Update a deploy trigger';

    protected function operationId(): string
    {
        return 'projects.deploy-triggers.update';
    }
}
