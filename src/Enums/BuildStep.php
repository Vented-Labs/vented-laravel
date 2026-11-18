<?php

declare(strict_types=1);

namespace Vented\Enums;

enum BuildStep: string
{
    case Clone = 'clone';
    case Install = 'install';
    case Build = 'build';
    case Release = 'release';
    case HealthCheck = 'health_check';
    case Switch = 'switch';
    case PostRelease = 'post_release';
}
