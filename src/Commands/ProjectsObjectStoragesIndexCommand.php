<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsObjectStoragesIndexCommand extends GeneratedCommand
{
    protected $signature = 'vented:object-storages:list {project : project path parameter} {environment : environment path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'List object storage buckets for an environment';

    protected function operationId(): string
    {
        return 'projects.object-storages.index';
    }
}
