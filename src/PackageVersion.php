<?php

declare(strict_types=1);

namespace Vented;

use Composer\InstalledVersions;

final class PackageVersion
{
    /**
     * This process-wide value is immutable, bounded, and contains no request data.
     */
    private static ?string $current = null;

    public static function current(): string
    {
        if (self::$current !== null) {
            return self::$current;
        }

        $installed = class_exists(InstalledVersions::class)
            ? InstalledVersions::getPrettyVersion('vented/vented-laravel')
            : null;

        if (is_string($installed) && $installed !== '' && ! str_starts_with($installed, 'dev-')) {
            return self::$current = ltrim($installed, 'v');
        }

        $version = @file_get_contents(dirname(__DIR__).'/VERSION');
        $version = is_string($version) ? trim($version) : '';

        return self::$current = $version !== '' ? $version : 'dev';
    }
}
