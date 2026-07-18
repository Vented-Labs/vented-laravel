<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsDnsZonesExportCommand extends GeneratedCommand
{
    protected $signature = 'vented:dns-zones:export {project : project path parameter} {zone : zone path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response} {--output= : Destination path, or - for stdout}';

    protected $description = 'Export a DNS zone';

    protected function operationId(): string
    {
        return 'projects.dns.zones.export';
    }
}
