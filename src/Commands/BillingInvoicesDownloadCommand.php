<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class BillingInvoicesDownloadCommand extends GeneratedCommand
{
    protected $signature = 'vented:account-invoices:download {invoice : invoice path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response} {--output= : Destination path, or - for stdout}';

    protected $description = 'Download an invoice PDF';

    protected function operationId(): string
    {
        return 'billing.invoices.download';
    }
}
