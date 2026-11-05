<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class AccountOrganizationsMembersIndexCommand extends GeneratedCommand
{
    protected $signature = 'vented:organization-members:list {organization : organization path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'List organization members';

    protected function operationId(): string
    {
        return 'account.organizations.members.index';
    }
}
