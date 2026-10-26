<?php

declare(strict_types=1);

namespace Vented\Enums;

enum AppDesiredStatus: string
{
    case Active = 'active';
    case Stopped = 'stopped';
    case Deleted = 'deleted';
}
