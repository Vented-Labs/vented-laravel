<?php

declare(strict_types=1);

namespace Vented\Enums;

enum GitConnectMode: string
{
    case AppInstall = 'app_install';
    case Oauth = 'oauth';
    case Token = 'token';
    case PerRepository = 'per_repository';
}
