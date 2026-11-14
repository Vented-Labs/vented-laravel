<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class SupportTicketsRepliesStoreCommand extends GeneratedCommand
{
    protected $signature = 'vented:support-ticket-replies:create {ticket : ticket path parameter} {--data= : JSON attributes or @path/to/file.json} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Add a reply to a ticket';

    protected function operationId(): string
    {
        return 'support.tickets.replies.store';
    }
}
