<?php

declare(strict_types=1);

namespace Vented\Enums;

enum EnvironmentTransferSecretPolicy: string
{
    case Strip = 'strip';
    case CopySelected = 'copy_selected';
}
