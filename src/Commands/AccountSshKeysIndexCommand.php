<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class AccountSshKeysIndexCommand extends GeneratedCommand
{
    protected $signature = 'vented:account-ssh-keys:list {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'List your SSH keys';

    protected function operationId(): string
    {
        return 'account.ssh-keys.index';
    }
}
