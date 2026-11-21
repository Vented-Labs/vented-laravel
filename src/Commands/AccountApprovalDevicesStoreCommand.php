<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class AccountApprovalDevicesStoreCommand extends GeneratedCommand
{
    protected $signature = 'vented:approval-devices:create {--data= : JSON attributes or @path/to/file.json} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Enroll this phone to approve agent requests';

    protected function operationId(): string
    {
        return 'account.approval-devices.store';
    }
}
