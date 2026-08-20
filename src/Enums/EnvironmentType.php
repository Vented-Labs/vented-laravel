<?php

declare(strict_types=1);

namespace Vented\Enums;

enum EnvironmentType: string
{
    case Production = 'production';
    case NonProduction = 'non_production';
}
