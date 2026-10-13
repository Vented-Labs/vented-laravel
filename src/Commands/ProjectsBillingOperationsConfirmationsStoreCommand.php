<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsBillingOperationsConfirmationsStoreCommand extends GeneratedCommand
{
    protected $signature = 'vented:billing-operation-confirmations:create {project : project path parameter} {operation : operation path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Create billing operation payment confirmation';

    protected function operationId(): string
    {
        return 'projects.billing.operations.confirmations.store';
    }
}
