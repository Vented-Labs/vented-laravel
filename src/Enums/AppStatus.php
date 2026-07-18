<?php

declare(strict_types=1);

namespace Vented\Enums;

enum AppStatus: string
{
    case Pending = 'pending';
    case Provisioning = 'provisioning';
    case Deploying = 'deploying';
    case Active = 'active';
    case Starting = 'starting';
    case Restarting = 'restarting';
    case Failed = 'failed';
    case Updating = 'updating';
    case Stopping = 'stopping';
    case Stopped = 'stopped';
    case Deleting = 'deleting';
    case Deleted = 'deleted';
}
