<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsDnsCertificatesBindingsDestroyCommand extends GeneratedCommand
{
    protected $signature = 'vented:dns-certificate-bindings:delete {project : project path parameter} {certificate : certificate path parameter} {binding : binding path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response} {--force : Skip destructive operation confirmation}';

    protected $description = 'Remove a custom certificate from a binding';

    protected function operationId(): string
    {
        return 'projects.dns.certificates.bindings.destroy';
    }
}
