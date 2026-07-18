<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsSshKeysDestroyCommand extends GeneratedCommand
{
    protected $signature = 'vented:ssh-keys:delete {project : project path parameter} {sshKey : sshKey path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response} {--force : Skip destructive operation confirmation}';

    protected $description = 'Revoke a SSH key from a project';

    protected function operationId(): string
    {
        return 'projects.ssh-keys.destroy';
    }
}
