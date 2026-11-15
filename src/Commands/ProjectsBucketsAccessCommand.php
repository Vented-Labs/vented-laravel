<?php

declare(strict_types=1);

namespace Vented\Commands;

use Vented\Console\GeneratedCommand;

final class ProjectsBucketsAccessCommand extends GeneratedCommand
{
    protected $signature = 'vented:bucket-access:list {project : project path parameter} {environment : environment path parameter} {bucket : bucket path parameter} {--query=* : Query parameter in key=value form (repeatable)} {--json : Print the raw JSON response}';

    protected $description = 'List bindings for a bucket';

    protected function operationId(): string
    {
        return 'projects.buckets.access';
    }
}
