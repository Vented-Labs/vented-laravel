<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class RealtimeShowCommand extends GeneratedCommand
{
    protected $signature = 'vented:realtime:get {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Show the live events connection';

    protected function operationId(): string
    {
        return 'realtime.show';
    }
}
