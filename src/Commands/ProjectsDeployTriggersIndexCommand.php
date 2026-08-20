<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsDeployTriggersIndexCommand extends GeneratedCommand
{
    protected $signature = 'vented:deploy-triggers:list {project : project path parameter} {environment : environment path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'List deploy triggers for an environment';

    protected function operationId(): string
    {
        return 'projects.deploy-triggers.index';
    }
}
