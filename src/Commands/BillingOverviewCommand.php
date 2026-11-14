<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class BillingOverviewCommand extends GeneratedCommand
{
    protected $signature = 'vented:account-billing:get {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Show billing overview';

    protected function operationId(): string
    {
        return 'billing.overview';
    }
}
