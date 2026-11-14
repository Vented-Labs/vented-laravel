<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class AccountSshKeysStoreCommand extends GeneratedCommand
{
    protected $signature = 'vented:account-ssh-keys:create {--data= : JSON attributes or @path/to/file.json} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Add an SSH key';

    protected function operationId(): string
    {
        return 'account.ssh-keys.store';
    }
}
