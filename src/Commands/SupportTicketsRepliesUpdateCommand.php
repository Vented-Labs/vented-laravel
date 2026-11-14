<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class SupportTicketsRepliesUpdateCommand extends GeneratedCommand
{
    protected $signature = 'vented:support-ticket-replies:update {ticket : ticket path parameter} {reply : reply path parameter} {--data= : JSON attributes or @path/to/file.json} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Edit a reply';

    protected function operationId(): string
    {
        return 'support.tickets.replies.update';
    }
}
