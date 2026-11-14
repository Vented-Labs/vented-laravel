<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class SupportKbShowCommand extends GeneratedCommand
{
    protected $signature = 'vented:support-kb:show {article : article path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Show a Knowledge Base article';

    protected function operationId(): string
    {
        return 'support.kb.show';
    }
}
