<?php

declare(strict_types=1);

namespace Vented\Enums;

enum EnvironmentStatus: string
{
    case Pending = 'pending';
    case Active = 'active';
    case Suspended = 'suspended';
    case Failed = 'failed';
    case Deleting = 'deleting';
    case Deleted = 'deleted';
}
