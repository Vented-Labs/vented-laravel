<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsServicesConfigurationCommand extends GeneratedCommand
{
    protected $signature = 'vented:services:configuration {project : project path parameter} {service : service path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Show service configuration';

    protected function operationId(): string
    {
        return 'projects.services.configuration';
    }
}
