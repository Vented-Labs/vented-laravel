<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsServicesBindingsUpdateCommand extends GeneratedCommand
{
    protected $signature = 'vented:service-bindings:update {project : project path parameter} {environment : environment path parameter} {service : service path parameter} {binding : binding path parameter} {--data= : JSON attributes or @path/to/file.json} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Set the declared purpose of a service binding';

    protected function operationId(): string
    {
        return 'projects.services.bindings.update';
    }
}
