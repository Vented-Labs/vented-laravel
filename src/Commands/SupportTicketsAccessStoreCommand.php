<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class SupportTicketsAccessStoreCommand extends GeneratedCommand
{
    protected $signature = 'vented:support-ticket-access:create {ticket : ticket path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Allow support access for a ticket';

    protected function operationId(): string
    {
        return 'support.tickets.access.store';
    }
}
