<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class SupportTicketsStoreCommand extends GeneratedCommand
{
    protected $signature = 'vented:support-tickets:create {--data= : JSON attributes or @path/to/file.json} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Open a support ticket';

    protected function operationId(): string
    {
        return 'support.tickets.store';
    }
}
