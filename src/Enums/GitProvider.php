<?php

declare(strict_types=1);

namespace Vented\Enums;

enum GitProvider: string
{
    case Github = 'github';
    case Gitlab = 'gitlab';
    case Bitbucket = 'bitbucket';
}
