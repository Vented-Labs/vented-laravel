<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsBillingPaymentMethodsStoreCommand extends GeneratedCommand
{
    protected $signature = 'vented:billing-payment-methods:create {project : project path parameter} {--data= : JSON attributes or @path/to/file.json} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Bind project payment method';

    protected function operationId(): string
    {
        return 'projects.billing.payment-methods.store';
    }
}
