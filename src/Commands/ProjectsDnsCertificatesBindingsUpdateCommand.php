<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsDnsCertificatesBindingsUpdateCommand extends GeneratedCommand
{
    protected $signature = 'vented:dns-certificate-bindings:update {project : project path parameter} {certificate : certificate path parameter} {binding : binding path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Install a custom certificate on a binding';

    protected function operationId(): string
    {
        return 'projects.dns.certificates.bindings.update';
    }
}
