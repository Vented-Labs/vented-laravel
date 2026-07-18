<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class AccountApiTokensStoreCommand extends GeneratedCommand
{
    protected $signature = 'vented:api-tokens:create {--data= : JSON attributes or @path/to/file.json} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Create an API token';

    protected function operationId(): string
    {
        return 'account.api-tokens.store';
    }
}
