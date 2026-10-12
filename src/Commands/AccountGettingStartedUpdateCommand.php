<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class AccountGettingStartedUpdateCommand extends GeneratedCommand
{
    protected $signature = 'vented:getting-started:update {--data= : JSON attributes or @path/to/file.json} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Set your onboarding preferences';

    protected function operationId(): string
    {
        return 'account.getting-started.update';
    }
}
