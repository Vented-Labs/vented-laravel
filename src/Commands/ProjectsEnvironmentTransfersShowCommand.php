<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsEnvironmentTransfersShowCommand extends GeneratedCommand
{
    protected $signature = 'vented:environment-transfers:show {project : project path parameter} {environment : environment path parameter} {transfer : transfer path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Show an environment configuration transfer';

    protected function operationId(): string
    {
        return 'projects.environment-transfers.show';
    }
}
