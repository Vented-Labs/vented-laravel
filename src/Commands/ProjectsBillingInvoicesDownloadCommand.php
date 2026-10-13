<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsBillingInvoicesDownloadCommand extends GeneratedCommand
{
    protected $signature = 'vented:billing-invoices:download {project : project path parameter} {invoice : invoice path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response} {--output= : Destination path, or - for stdout}';

    protected $description = 'Download a project invoice';

    protected function operationId(): string
    {
        return 'projects.billing.invoices.download';
    }
}
