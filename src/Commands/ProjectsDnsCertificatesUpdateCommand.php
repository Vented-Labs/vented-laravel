<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsDnsCertificatesUpdateCommand extends GeneratedCommand
{
    protected $signature = 'vented:dns-certificates:update {project : project path parameter} {certificate : certificate path parameter} {--data= : JSON attributes or @path/to/file.json} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Rename or replace a custom certificate';

    protected function operationId(): string
    {
        return 'projects.dns.certificates.update';
    }
}
