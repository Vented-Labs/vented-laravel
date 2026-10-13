<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsBillingShowCommand extends GeneratedCommand
{
    protected $signature = 'vented:billing:show {project : project path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Show project billing, plans and usage';

    protected function operationId(): string
    {
        return 'projects.billing.show';
    }
}
