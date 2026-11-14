<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class BillingInvoicesIndexCommand extends GeneratedCommand
{
    protected $signature = 'vented:account-invoices:list {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'List invoices';

    protected function operationId(): string
    {
        return 'billing.invoices.index';
    }
}
