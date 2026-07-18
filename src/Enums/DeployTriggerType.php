<?php

declare(strict_types=1);

namespace Vented\Enums;

enum DeployTriggerType: string
{
    case Manual = 'manual';
    case Webhook = 'webhook';
    case GitPush = 'git_push';
    case Scheduled = 'scheduled';
}
