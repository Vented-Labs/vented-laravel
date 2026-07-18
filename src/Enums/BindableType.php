<?php

declare(strict_types=1);

namespace Vented\Enums;

enum BindableType: string
{
    case App = 'app';
    case Service = 'service';
}
