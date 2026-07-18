<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsDnsZonesRecordsIndexCommand extends GeneratedCommand
{
    protected $signature = 'vented:dns-zone-records:list {project : project path parameter} {zone : zone path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'List records for a zone';

    protected function operationId(): string
    {
        return 'projects.dns.zones.records.index';
    }
}
