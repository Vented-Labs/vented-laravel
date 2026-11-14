<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class AccountSshKeysDestroyCommand extends GeneratedCommand
{
    protected $signature = 'vented:account-ssh-keys:delete {key : key path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response} {--force : Skip destructive operation confirmation}';

    protected $description = 'Remove an SSH key';

    protected function operationId(): string
    {
        return 'account.ssh-keys.destroy';
    }
}
