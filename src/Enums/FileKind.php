<?php

declare(strict_types=1);

namespace Vented\Enums;

enum FileKind: string
{
    case File = 'file';
    case Directory = 'directory';
    case Symlink = 'symlink';
    case Other = 'other';
}
