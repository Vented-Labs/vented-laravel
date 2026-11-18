<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsDnsCertificatesShowCommand extends GeneratedCommand
{
    protected $signature = 'vented:dns-certificates:show {project : project path parameter} {certificate : certificate path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Show a custom certificate';

    protected function operationId(): string
    {
        return 'projects.dns.certificates.show';
    }
}
