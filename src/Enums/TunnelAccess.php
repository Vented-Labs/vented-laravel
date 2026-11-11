<?php

declare(strict_types=1);

namespace Vented\Enums;

enum TunnelAccess: string
{
    case Private = 'private';
    case Public = 'public';
}
