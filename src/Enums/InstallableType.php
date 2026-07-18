<?php

declare(strict_types=1);

namespace Vented\Enums;

enum InstallableType: string
{
    case Runtime = 'runtime';
    case Addon = 'addon';
}
