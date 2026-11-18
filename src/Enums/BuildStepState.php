<?php

declare(strict_types=1);

namespace Vented\Enums;

enum BuildStepState: string
{
    case Done = 'done';
    case Current = 'current';
    case Failed = 'failed';
    case Upcoming = 'upcoming';
}
