<?php

declare(strict_types=1);

namespace Vented\Enums;

enum DeployTargetKind: string
{
    case BuildGroup = 'build_group';
    case BuildConfig = 'build_config';
}
