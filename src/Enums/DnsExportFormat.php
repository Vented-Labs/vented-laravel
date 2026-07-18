<?php

declare(strict_types=1);

namespace Vented\Enums;

enum DnsExportFormat: string
{
    case Md = 'md';
    case Csv = 'csv';
    case Bind = 'bind';
}
