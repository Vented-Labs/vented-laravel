<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsEnvironmentTransfersUpdateCommand extends GeneratedCommand
{
    protected $signature = 'vented:environment-transfers:update {project : project path parameter} {environment : environment path parameter} {transfer : transfer path parameter} {--data= : JSON attributes or @path/to/file.json} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Update or apply an environment configuration transfer';

    protected function operationId(): string
    {
        return 'projects.environment-transfers.update';
    }
}
