<?php

declare(strict_types=1);

namespace Vented\Enums;

enum EnvironmentTransferStatus: string
{
    case Draft = 'draft';
    case Ready = 'ready';
    case Queued = 'queued';
    case Running = 'running';
    case Waiting = 'waiting';
    case Completed = 'completed';
    case PartiallyFailed = 'partially_failed';
    case Failed = 'failed';
    case Cancelled = 'cancelled';
}
