<?php

declare(strict_types=1);

namespace Vented\Enums;

enum DeployType: string
{
    case InPlace = 'in_place';
    case Builds = 'builds';
    case Container = 'container';
}
