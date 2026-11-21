<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class AccountApprovalDevicesShowCommand extends GeneratedCommand
{
    protected $signature = 'vented:approval-devices:show {device : device path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Show an enrolled phone';

    protected function operationId(): string
    {
        return 'account.approval-devices.show';
    }
}
