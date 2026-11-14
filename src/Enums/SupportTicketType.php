<?php

declare(strict_types=1);

namespace Vented\Enums;

enum SupportTicketType: string
{
    case Technical = 'technical';
    case Billing = 'billing';
    case Sales = 'sales';
    case Legal = 'legal';
    case LegalCsam = 'legal_csam';
}
