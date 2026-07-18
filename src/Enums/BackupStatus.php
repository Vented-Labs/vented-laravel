<?php

declare(strict_types=1);

namespace Vented\Enums;

enum BackupStatus: string
{
    case Pending = 'pending';
    case Queued = 'queued';
    case Running = 'running';
    case Completed = 'completed';
    case Failed = 'failed';
}
