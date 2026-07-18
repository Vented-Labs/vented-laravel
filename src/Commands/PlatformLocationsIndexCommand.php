<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class PlatformLocationsIndexCommand extends GeneratedCommand
{
    protected $signature = 'vented:platform-locations:list {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'List project locations';

    protected function operationId(): string
    {
        return 'platform-locations.index';
    }
}
