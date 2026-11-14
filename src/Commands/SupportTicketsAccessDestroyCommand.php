<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class SupportTicketsAccessDestroyCommand extends GeneratedCommand
{
    protected $signature = 'vented:support-ticket-access:delete {ticket : ticket path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response} {--force : Skip destructive operation confirmation}';

    protected $description = 'Stop support access for a ticket';

    protected function operationId(): string
    {
        return 'support.tickets.access.destroy';
    }
}
