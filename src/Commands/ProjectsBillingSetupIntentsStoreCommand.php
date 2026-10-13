<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsBillingSetupIntentsStoreCommand extends GeneratedCommand
{
    protected $signature = 'vented:billing-setup-intents:create {project : project path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Create project payment setup';

    protected function operationId(): string
    {
        return 'projects.billing.setup-intents.store';
    }
}
