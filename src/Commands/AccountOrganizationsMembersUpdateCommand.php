<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class AccountOrganizationsMembersUpdateCommand extends GeneratedCommand
{
    protected $signature = 'vented:organization-members:update {organization : organization path parameter} {member : member path parameter} {--data= : JSON attributes or @path/to/file.json} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Change a member\'s role or project access';

    protected function operationId(): string
    {
        return 'account.organizations.members.update';
    }
}
