<?php

declare(strict_types=1);

namespace Vented\Enums;

enum EnvironmentTransferAction: string
{
    case Create = 'create';
    case Update = 'update';
    case Map = 'map';
    case Skip = 'skip';
}
