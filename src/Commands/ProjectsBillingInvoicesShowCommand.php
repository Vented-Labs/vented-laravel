<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsBillingInvoicesShowCommand extends GeneratedCommand
{
    protected $signature = 'vented:billing-invoices:show {project : project path parameter} {invoice : invoice path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Show a project invoice';

    protected function operationId(): string
    {
        return 'projects.billing.invoices.show';
    }
}
