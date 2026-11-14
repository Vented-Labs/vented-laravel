<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class AccountTwoFactorShowCommand extends GeneratedCommand
{
    protected $signature = 'vented:two-factor:show {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Show two-factor authentication settings';

    protected function operationId(): string
    {
        return 'account.two-factor.show';
    }
}
