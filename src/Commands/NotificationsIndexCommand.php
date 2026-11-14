<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class NotificationsIndexCommand extends GeneratedCommand
{
    protected $signature = 'vented:notifications:list {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'List your notifications';

    protected function operationId(): string
    {
        return 'notifications.index';
    }
}
