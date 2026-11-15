<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsEmailDomainsIndexCommand extends GeneratedCommand
{
    protected $signature = 'vented:email-domains:list {project : project path parameter} {environment : environment path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'List sending domains for an environment';

    protected function operationId(): string
    {
        return 'projects.email.domains.index';
    }
}
