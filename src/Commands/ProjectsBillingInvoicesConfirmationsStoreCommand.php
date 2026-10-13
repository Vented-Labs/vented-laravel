<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsBillingInvoicesConfirmationsStoreCommand extends GeneratedCommand
{
    protected $signature = 'vented:billing-invoice-confirmations:create {project : project path parameter} {invoice : invoice path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Create invoice payment confirmation';

    protected function operationId(): string
    {
        return 'projects.billing.invoices.confirmations.store';
    }
}
