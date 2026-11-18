<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsDnsCertificatesDestroyCommand extends GeneratedCommand
{
    protected $signature = 'vented:dns-certificates:delete {project : project path parameter} {certificate : certificate path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response} {--force : Skip destructive operation confirmation}';

    protected $description = 'Delete a custom certificate';

    protected function operationId(): string
    {
        return 'projects.dns.certificates.destroy';
    }
}
