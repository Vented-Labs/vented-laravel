<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsDnsZonesRecordsUpdateCommand extends GeneratedCommand
{
    protected $signature = 'vented:dns-zone-records:update {project : project path parameter} {zone : zone path parameter} {record : record path parameter} {--data= : JSON attributes or @path/to/file.json} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Update a DNS record';

    protected function operationId(): string
    {
        return 'projects.dns.zones.records.update';
    }
}
