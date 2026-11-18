<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class AccountApiTokensCurrentCommand extends GeneratedCommand
{
    protected $signature = 'vented:api-tokens:current {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Show the API token making this request';

    protected function operationId(): string
    {
        return 'account.api-tokens.current';
    }
}
