<?php

declare(strict_types=1);

namespace Vented\Enums;

enum ProjectRole: string
{
    case Admin = 'admin';
    case Member = 'member';
}
