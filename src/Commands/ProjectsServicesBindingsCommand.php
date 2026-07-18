<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsServicesBindingsCommand extends GeneratedCommand
{
    protected $signature = 'vented:service-bindings:list {project : project path parameter} {service : service path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'List bindings for a service';

    protected function operationId(): string
    {
        return 'projects.services.bindings';
    }
}
