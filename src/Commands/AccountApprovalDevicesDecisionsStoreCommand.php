<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class AccountApprovalDevicesDecisionsStoreCommand extends GeneratedCommand
{
    protected $signature = 'vented:approval-device-decisions:create {device : device path parameter} {--data= : JSON attributes or @path/to/file.json} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Approve or deny an agent request from this phone';

    protected function operationId(): string
    {
        return 'account.approval-devices.decisions.store';
    }
}
