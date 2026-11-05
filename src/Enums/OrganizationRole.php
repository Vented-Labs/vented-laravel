<?php

declare(strict_types=1);

namespace Vented\Enums;

enum OrganizationRole: string
{
    case Owner = 'owner';
    case Admin = 'admin';
    case Member = 'member';
}
