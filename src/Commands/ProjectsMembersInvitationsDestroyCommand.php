<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsMembersInvitationsDestroyCommand extends GeneratedCommand
{
    protected $signature = 'vented:member-invitations:delete {project : project path parameter} {invitation : invitation path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response} {--force : Skip destructive operation confirmation}';

    protected $description = 'Cancel a pending invitation';

    protected function operationId(): string
    {
        return 'projects.members.invitations.destroy';
    }
}
