<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsSshKeysIndexCommand extends GeneratedCommand
{
    protected $signature = 'vented:ssh-keys:list {project : project path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'List SSH keys with deploy access to a project';

    protected function operationId(): string
    {
        return 'projects.ssh-keys.index';
    }
}
