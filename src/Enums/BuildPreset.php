<?php

declare(strict_types=1);

namespace Vented\Enums;

enum BuildPreset: string
{
    case Laravel = 'laravel';
    case Statamic = 'statamic';
    case WordpressTheme = 'wordpress_theme';
    case Nextjs = 'nextjs';
    case Nuxt = 'nuxt';
    case Node = 'node';
    case StaticSite = 'static_site';
}
