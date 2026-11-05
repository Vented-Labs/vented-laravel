<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class AccountOrganizationsSettingsCommand extends GeneratedCommand
{
    protected $signature = 'vented:organization-settings:list {organization : organization path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Show organization settings';

    protected function operationId(): string
    {
        return 'account.organizations.settings';
    }
}
