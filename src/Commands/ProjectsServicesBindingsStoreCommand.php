<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsServicesBindingsStoreCommand extends GeneratedCommand
{
    protected $signature = 'vented:service-bindings:create {project : project path parameter} {service : service path parameter} {--data= : JSON attributes or @path/to/file.json} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Create a binding from a service';

    protected function operationId(): string
    {
        return 'projects.services.bindings.store';
    }
}
