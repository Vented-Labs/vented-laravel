<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class AccountOrganizationsIndexCommand extends GeneratedCommand
{
    protected $signature = 'vented:organizations:list {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'List your organizations';

    protected function operationId(): string
    {
        return 'account.organizations.index';
    }
}
