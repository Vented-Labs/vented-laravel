<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class AccountGettingStartedShowCommand extends GeneratedCommand
{
    protected $signature = 'vented:getting-started:show {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Show your getting started guide';

    protected function operationId(): string
    {
        return 'account.getting-started.show';
    }
}
