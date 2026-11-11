<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsTunnelsStartCommand extends GeneratedCommand
{
    protected $signature = 'vented:tunnels:start {project : project path parameter} {environment : environment path parameter} {tunnel : tunnel path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Start a tunnel';

    protected function operationId(): string
    {
        return 'projects.tunnels.start';
    }
}
