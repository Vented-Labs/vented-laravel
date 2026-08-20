<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsSshKeysStoreCommand extends GeneratedCommand
{
    protected $signature = 'vented:ssh-keys:create {project : project path parameter} {environment : environment path parameter} {--data= : JSON attributes or @path/to/file.json} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Grant an SSH key access to an environment';

    protected function operationId(): string
    {
        return 'projects.ssh-keys.store';
    }
}
