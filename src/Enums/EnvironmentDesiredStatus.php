<?php

declare(strict_types=1);

namespace Vented\Enums;

enum EnvironmentDesiredStatus: string
{
    case Active = 'active';
    case Suspended = 'suspended';
    case Deleted = 'deleted';
}
