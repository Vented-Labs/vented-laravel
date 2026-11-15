<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsEmailDomainsAccessCommand extends GeneratedCommand
{
    protected $signature = 'vented:email-domain-access:list {project : project path parameter} {environment : environment path parameter} {sendingDomain : sendingDomain path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'List bindings for a sending domain';

    protected function operationId(): string
    {
        return 'projects.email.domains.access';
    }
}
