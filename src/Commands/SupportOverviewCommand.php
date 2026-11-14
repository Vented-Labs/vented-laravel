<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class SupportOverviewCommand extends GeneratedCommand
{
    protected $signature = 'vented:support:show {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Support center overview';

    protected function operationId(): string
    {
        return 'support.overview';
    }
}
