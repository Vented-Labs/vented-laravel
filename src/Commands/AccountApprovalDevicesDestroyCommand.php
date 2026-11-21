<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class AccountApprovalDevicesDestroyCommand extends GeneratedCommand
{
    protected $signature = 'vented:approval-devices:delete {device : device path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response} {--force : Skip destructive operation confirmation}';

    protected $description = 'Remove an enrolled phone';

    protected function operationId(): string
    {
        return 'account.approval-devices.destroy';
    }
}
