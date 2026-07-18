<?php

declare(strict_types=1);

namespace Vented\Enums;

enum IntegrationType: string
{
    case Git = 'git';
    case Logging = 'logging';
    case Notifications = 'notifications';
    case Monitoring = 'monitoring';
    case Storage = 'storage';
}
