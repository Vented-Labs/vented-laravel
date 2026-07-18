<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class AccountApiTokensIndexCommand extends GeneratedCommand
{
    protected $signature = 'vented:api-tokens:list {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'List your API tokens';

    protected function operationId(): string
    {
        return 'account.api-tokens.index';
    }
}
