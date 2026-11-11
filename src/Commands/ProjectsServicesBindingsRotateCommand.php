<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsServicesBindingsRotateCommand extends GeneratedCommand
{
    protected $signature = 'vented:service-bindings:rotate {project : project path parameter} {environment : environment path parameter} {service : service path parameter} {binding : binding path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Rotate a service binding\'s credentials';

    protected function operationId(): string
    {
        return 'projects.services.bindings.rotate';
    }
}
