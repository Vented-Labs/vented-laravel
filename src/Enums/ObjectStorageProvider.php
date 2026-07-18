<?php

declare(strict_types=1);

namespace Vented\Enums;

enum ObjectStorageProvider: string
{
    case Vented = 'vented';
    case Edge = 'edge';
    case R2 = 'r2';
    case Byos3 = 'byos3';
}
