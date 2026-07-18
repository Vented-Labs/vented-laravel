<?php

declare(strict_types=1);

namespace Vented\Enums;

enum DomainService: string
{
    case Dns = 'dns';
    case Web = 'web';
    case Email = 'email';
}
