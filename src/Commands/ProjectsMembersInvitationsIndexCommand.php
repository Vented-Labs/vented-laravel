<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsMembersInvitationsIndexCommand extends GeneratedCommand
{
    protected $signature = 'vented:member-invitations:list {project : project path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'List pending project invitations';

    protected function operationId(): string
    {
        return 'projects.members.invitations.index';
    }
}
