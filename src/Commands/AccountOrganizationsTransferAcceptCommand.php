<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class AccountOrganizationsTransferAcceptCommand extends GeneratedCommand
{
    protected $signature = 'vented:organization-transfer:accept {organization : organization path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Accept an organization transfer';

    protected function operationId(): string
    {
        return 'account.organizations.transfer.accept';
    }
}
