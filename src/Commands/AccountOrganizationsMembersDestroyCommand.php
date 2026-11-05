<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class AccountOrganizationsMembersDestroyCommand extends GeneratedCommand
{
    protected $signature = 'vented:organization-members:delete {organization : organization path parameter} {member : member path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response} {--force : Skip destructive operation confirmation}';

    protected $description = 'Remove someone from an organization';

    protected function operationId(): string
    {
        return 'account.organizations.members.destroy';
    }
}
