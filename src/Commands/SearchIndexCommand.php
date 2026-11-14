<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class SearchIndexCommand extends GeneratedCommand
{
    protected $signature = 'vented:search:list {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Search projects, knowledge-base articles, and navigation entries';

    protected function operationId(): string
    {
        return 'search.index';
    }
}
