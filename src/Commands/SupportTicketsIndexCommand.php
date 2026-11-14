<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class SupportTicketsIndexCommand extends GeneratedCommand
{
    protected $signature = 'vented:support-tickets:list {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'List your support tickets';

    protected function operationId(): string
    {
        return 'support.tickets.index';
    }
}
