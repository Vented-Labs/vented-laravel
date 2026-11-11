<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsServicesOutputsCommand extends GeneratedCommand
{
    protected $signature = 'vented:services:outputs {project : project path parameter} {environment : environment path parameter} {service : service path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Show a service\'s connection details';

    protected function operationId(): string
    {
        return 'projects.services.outputs';
    }
}
