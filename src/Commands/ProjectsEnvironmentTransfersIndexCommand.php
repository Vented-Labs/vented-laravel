<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsEnvironmentTransfersIndexCommand extends GeneratedCommand
{
    protected $signature = 'vented:environment-transfers:list {project : project path parameter} {environment : environment path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'List environment configuration transfers';

    protected function operationId(): string
    {
        return 'projects.environment-transfers.index';
    }
}
