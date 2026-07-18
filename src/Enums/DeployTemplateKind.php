<?php

declare(strict_types=1);

namespace Vented\Enums;

enum DeployTemplateKind: string
{
    case Package = 'package';
    case Gitops = 'gitops';
    case Automation = 'automation';
}
