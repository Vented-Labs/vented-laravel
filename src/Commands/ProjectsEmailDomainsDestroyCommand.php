<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsEmailDomainsDestroyCommand extends GeneratedCommand
{
    protected $signature = 'vented:email-domains:delete {project : project path parameter} {environment : environment path parameter} {sendingDomain : sendingDomain path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response} {--force : Skip destructive operation confirmation}';

    protected $description = 'Remove a sending domain';

    protected function operationId(): string
    {
        return 'projects.email.domains.destroy';
    }
}
