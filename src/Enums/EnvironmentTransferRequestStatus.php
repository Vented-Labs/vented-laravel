<?php

declare(strict_types=1);

namespace Vented\Enums;

enum EnvironmentTransferRequestStatus: string
{
    case Queued = 'queued';
    case Cancelled = 'cancelled';
}
