<?php

declare(strict_types=1);

namespace Vented\Enums;

enum TunnelType: string
{
    case Tcp = 'tcp';
    case Udp = 'udp';
    case Http = 'http';
}
