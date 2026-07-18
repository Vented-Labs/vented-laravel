<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsMembersInvitationsStoreCommand extends GeneratedCommand
{
    protected $signature = 'vented:member-invitations:create {project : project path parameter} {--data= : JSON attributes or @path/to/file.json} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'Invite a member to the project';

    protected function operationId(): string
    {
        return 'projects.members.invitations.store';
    }
}
