<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class AccountFlowsShowCommand extends GeneratedCommand
{
    protected $signature = 'vented:flows:show {flow : flow path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Show a flow';

    protected function operationId(): string
    {
        return 'account.flows.show';
    }
}
