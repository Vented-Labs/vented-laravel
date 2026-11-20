<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class AccountAiAgentsIndexCommand extends GeneratedCommand
{
    protected $signature = 'vented:ai-agents:list {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'List your connected AI agents';

    protected function operationId(): string
    {
        return 'account.ai-agents.index';
    }
}
