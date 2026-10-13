<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsBillingCancellationsStoreCommand extends GeneratedCommand
{
    protected $signature = 'vented:billing-cancellations:create {project : project path parameter} {--data= : JSON attributes or @path/to/file.json} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Cancel project billing';

    protected function operationId(): string
    {
        return 'projects.billing.cancellations.store';
    }
}
