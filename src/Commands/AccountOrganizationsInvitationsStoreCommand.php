<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class AccountOrganizationsInvitationsStoreCommand extends GeneratedCommand
{
    protected $signature = 'vented:organization-invitations:create {organization : organization path parameter} {--data= : JSON attributes or @path/to/file.json} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Invite someone to an organization';

    protected function operationId(): string
    {
        return 'account.organizations.invitations.store';
    }
}
