<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsTunnelsAgentSetupCommand extends GeneratedCommand
{
    protected $signature = 'vented:tunnels:agent-setup {project : project path parameter} {environment : environment path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Show how an agent connects to the tunnel server';

    protected function operationId(): string
    {
        return 'projects.tunnels.agent-setup';
    }
}
