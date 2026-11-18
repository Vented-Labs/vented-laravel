<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsBuildConfigsIndexCommand extends GeneratedCommand
{
    protected $signature = 'vented:build-configs:list {project : project path parameter} {environment : environment path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'List build configurations';

    protected function operationId(): string
    {
        return 'projects.build-configs.index';
    }
}
