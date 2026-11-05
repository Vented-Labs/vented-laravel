<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class AccountOrganizationsShowCommand extends GeneratedCommand
{
    protected $signature = 'vented:organizations:show {organization : organization path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Show an organization';

    protected function operationId(): string
    {
        return 'account.organizations.show';
    }
}
