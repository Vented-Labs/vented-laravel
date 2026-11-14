<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class SupportTicketsShowCommand extends GeneratedCommand
{
    protected $signature = 'vented:support-tickets:show {ticket : ticket path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Show a support ticket with its full reply thread';

    protected function operationId(): string
    {
        return 'support.tickets.show';
    }
}
