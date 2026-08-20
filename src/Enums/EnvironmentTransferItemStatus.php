<?php

declare(strict_types=1);

namespace Vented\Enums;

enum EnvironmentTransferItemStatus: string
{
    case Pending = 'pending';
    case Blocked = 'blocked';
    case Running = 'running';
    case Waiting = 'waiting';
    case Completed = 'completed';
    case Failed = 'failed';
    case Skipped = 'skipped';
}
