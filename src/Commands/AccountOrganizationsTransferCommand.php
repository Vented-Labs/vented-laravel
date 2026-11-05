<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class AccountOrganizationsTransferCommand extends GeneratedCommand
{
    protected $signature = 'vented:organizations:transfer {organization : organization path parameter} {--data= : JSON attributes or @path/to/file.json} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Offer an organization to another member';

    protected function operationId(): string
    {
        return 'account.organizations.transfer';
    }
}
