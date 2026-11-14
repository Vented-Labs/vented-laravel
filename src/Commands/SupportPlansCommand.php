<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class SupportPlansCommand extends GeneratedCommand
{
    protected $signature = 'vented:support-plans:list {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'List support plans';

    protected function operationId(): string
    {
        return 'support.plans';
    }
}
