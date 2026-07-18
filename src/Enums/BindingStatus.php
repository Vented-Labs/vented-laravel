<?php

declare(strict_types=1);

namespace Vented\Enums;

enum BindingStatus: string
{
    case Syncing = 'syncing';
    case Active = 'active';
}
