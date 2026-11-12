<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class AccountFlowsRunsStoreCommand extends GeneratedCommand
{
    protected $signature = 'vented:flow-runs:create {flow : flow path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Finish a flow';

    protected function operationId(): string
    {
        return 'account.flows.runs.store';
    }
}
