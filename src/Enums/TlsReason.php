<?php

declare(strict_types=1);

namespace Vented\Enums;

enum TlsReason: string
{
    case Verification = 'verification';
    case Dns = 'dns';
    case Issuing = 'issuing';
    case Installing = 'installing';
    case Renewal = 'renewal';
    case Caa = 'caa';
    case Validation = 'validation';
    case Ca = 'ca';
    case Expired = 'expired';
    case NotCovered = 'not_covered';
}
