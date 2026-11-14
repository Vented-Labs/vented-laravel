<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class NotificationsReadAllCommand extends GeneratedCommand
{
    protected $signature = 'vented:notifications:read-all {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Mark every notification as read';

    protected function operationId(): string
    {
        return 'notifications.read-all';
    }
}
