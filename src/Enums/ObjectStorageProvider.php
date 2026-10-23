<?php

declare(strict_types=1);

namespace Vented\Enums;

enum ObjectStorageProvider: string
{
    case Vented = 'vented';
    case Byos3 = 'byos3';
}
