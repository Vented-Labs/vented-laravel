<?php

declare(strict_types=1);

namespace Vented\Enums;

enum BackupType: string
{
    case Full = 'full';
    case Database = 'database';
    case Files = 'files';
}
