<?php

declare(strict_types=1);

namespace Vented\Enums;

enum SearchableType: string
{
    case Zone = 'zone';
    case App = 'app';
    case Storage = 'storage';
    case Member = 'member';
    case Ticket = 'ticket';
    case Integration = 'integration';
}
