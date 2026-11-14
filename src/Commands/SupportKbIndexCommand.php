<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class SupportKbIndexCommand extends GeneratedCommand
{
    protected $signature = 'vented:support-kb:list {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'List Knowledge Base articles';

    protected function operationId(): string
    {
        return 'support.kb.index';
    }
}
