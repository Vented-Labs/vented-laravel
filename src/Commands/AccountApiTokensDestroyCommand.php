<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class AccountApiTokensDestroyCommand extends GeneratedCommand
{
    protected $signature = 'vented:api-tokens:delete {token : token path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response} {--force : Skip destructive operation confirmation}';

    protected $description = 'Revoke an API token';

    protected function operationId(): string
    {
        return 'account.api-tokens.destroy';
    }
}
