<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsIntegrationsShowCommand extends GeneratedCommand
{
    protected $signature = 'vented:integrations:show {project : project path parameter} {integration : integration path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Show an integration';

    protected function operationId(): string
    {
        return 'projects.integrations.show';
    }
}
