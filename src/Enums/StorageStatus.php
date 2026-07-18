<?php

declare(strict_types=1);

namespace Vented\Enums;

enum StorageStatus: string
{
    case Pending = 'pending';
    case Provisioning = 'provisioning';
    case Active = 'active';
    case Failed = 'failed';
    case Resizing = 'resizing';
    case Deleting = 'deleting';
    case Deleted = 'deleted';
}
