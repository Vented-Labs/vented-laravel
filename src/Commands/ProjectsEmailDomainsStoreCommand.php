<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsEmailDomainsStoreCommand extends GeneratedCommand
{
    protected $signature = 'vented:email-domains:create {project : project path parameter} {environment : environment path parameter} {--data= : JSON attributes or @path/to/file.json} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Add a sending domain';

    protected function operationId(): string
    {
        return 'projects.email.domains.store';
    }
}
