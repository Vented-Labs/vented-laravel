<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class AccountApiTokensUpdateCommand extends GeneratedCommand
{
    protected $signature = 'vented:api-tokens:update {token : token path parameter} {--data= : JSON attributes or @path/to/file.json} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Change an API token\'s permissions';

    protected function operationId(): string
    {
        return 'account.api-tokens.update';
    }
}
