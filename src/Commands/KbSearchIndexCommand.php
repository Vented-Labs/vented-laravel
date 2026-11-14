<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class KbSearchIndexCommand extends GeneratedCommand
{
    protected $signature = 'vented:kb-search:list {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Search the public knowledge base';

    protected function operationId(): string
    {
        return 'kb.search.index';
    }
}
