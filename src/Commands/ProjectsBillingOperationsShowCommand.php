<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsBillingOperationsShowCommand extends GeneratedCommand
{
    protected $signature = 'vented:billing-operations:show {project : project path parameter} {operation : operation path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Show billing operation settlement';

    protected function operationId(): string
    {
        return 'projects.billing.operations.show';
    }
}
