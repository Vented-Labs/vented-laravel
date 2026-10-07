<?php

declare(strict_types=1);

namespace Vented\Enums;

enum StatusTone: string
{
    case Success = 'success';
    case Info = 'info';
    case Warning = 'warning';
    case Danger = 'danger';
    case Neutral = 'neutral';
}
