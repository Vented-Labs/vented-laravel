<?php

declare(strict_types=1);

namespace Vented\Enums;

enum TlsMode: string
{
    case Auto = 'auto';
    case Custom = 'custom';
}
