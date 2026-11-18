<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsDnsCertificatesIndexCommand extends GeneratedCommand
{
    protected $signature = 'vented:dns-certificates:list {project : project path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'List custom certificates';

    protected function operationId(): string
    {
        return 'projects.dns.certificates.index';
    }
}
