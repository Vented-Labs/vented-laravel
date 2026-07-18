<?php

declare(strict_types=1);

namespace Vented\Enums;

enum DnsRecordType: string
{
    case A = 'A';
    case AAAA = 'AAAA';
    case CNAME = 'CNAME';
    case TXT = 'TXT';
    case MX = 'MX';
    case Redirect = 'Redirect';
    case Flatten = 'Flatten';
    case SRV = 'SRV';
    case CAA = 'CAA';
    case PTR = 'PTR';
    case NS = 'NS';
}
