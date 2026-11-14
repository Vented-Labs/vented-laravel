<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class AccountSettingsUpdateCommand extends GeneratedCommand
{
    protected $signature = 'vented:account-settings:update {--data= : JSON attributes or @path/to/file.json} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Update account settings';

    protected function operationId(): string
    {
        return 'account.settings.update';
    }
}
