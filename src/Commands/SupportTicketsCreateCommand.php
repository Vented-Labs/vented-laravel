<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class SupportTicketsCreateCommand extends GeneratedCommand
{
    protected $signature = 'vented:support-tickets:form-options {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Show the create-ticket scaffolding';

    protected function operationId(): string
    {
        return 'support.tickets.create';
    }
}
