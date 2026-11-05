<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class AccountOrganizationsDestroyCommand extends GeneratedCommand
{
    protected $signature = 'vented:organizations:delete {organization : organization path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response} {--force : Skip destructive operation confirmation}';

    protected $description = 'Delete an organization';

    protected function operationId(): string
    {
        return 'account.organizations.destroy';
    }
}
